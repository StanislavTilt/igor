<?php

namespace App\Services;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Exceptions\WrongDataForAuthException;
use App\Mail\AuthCode;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService implements AuthServiceInterface
{
    protected AuthRepositoryInterface $repository;

    /**
     * AuthService constructor.
     * @param AuthRepositoryInterface $repository
     */
    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $validatedData
     * @return array
     * @throws WrongDataForAuthException
     */
    public function loginAttempt(array $validatedData): User
    {
        try {
            $user = $this->repository->findByEmail($validatedData['email']);
        } catch (ModelNotFoundException $exception) {
            throw new WrongDataForAuthException();
        }

        $this->sendMail($user);

        return $user;
    }

    /**
     * @param array $validatedData
     * @return User
     * @throws WrongDataForAuthException
     */
    public function loginConfirm(array $validatedData): User
    {
        try {
            $user = $this->repository->findById($validatedData['user_id']);
        } catch (ModelNotFoundException $exception) {
            throw new WrongDataForAuthException();
        }

        if(!$this->validateCode($validatedData['code'], $user))
        {
            throw new WrongDataForAuthException('code invalid');
        }

        $user->token = $user->createToken('login')->plainTextToken;

        return $user;
    }

    /**
     * @param array $validatedData
     * @return User
     * @throws \Exception
     */
    public function registerAttempt(array $validatedData): User
    {
        $user = $this->repository->createUser($validatedData);
        $this->sendMail($user);
        return $user;
    }

    /**
     * @param array $validatedData
     * @return User
     * @throws WrongDataForAuthException
     */
    public function registerConfirm(array $validatedData): User
    {
        try {
            $user = $this->repository->findById($validatedData['user_id']);
        } catch (ModelNotFoundException $exception) {
            throw new WrongDataForAuthException();
        }

        if(!$this->validateCode($validatedData['code'], $user))
        {
            $this->repository->deleteUser($user->id);
            throw new WrongDataForAuthException('code invalid');
        }

        $user->token = $user->createToken('login')->plainTextToken;

        return $user;
    }

    /**
     * @param User $user
     * @return mixed|void
     * @throws \Exception
     */
    public function sendMail(User $user): void
    {
        $code = $this->createCode($user);
        Mail::to($user)->send(new AuthCode($code, $user));
    }

    /**
     * @param User $user
     * @return string
     * @throws \Exception
     */
    public function createCode(User $user): string
    {
        $code = bin2hex(random_bytes(3));
        Cache::put(
            'code.'.$user->id,
            $code,
            now()->addMinutes(2)
        );
        return $code;
    }

    /**
     * @param string $code
     * @param User $user
     * @return bool
     */
    public function validateCode(string $code, User $user): bool
    {
        $tempCode = Cache::get('code.'.$user->id);
        if($tempCode == $code)
        {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public function logout(): void
    {
        request()->user()->currentAccessToken()->delete();
    }
}
