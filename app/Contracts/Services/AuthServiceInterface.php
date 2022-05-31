<?php

namespace App\Contracts\Services;

use App\Models\User;

/**
 * Interface AuthServiceInterface
 * @package App\Contracts\Services
 */
interface AuthServiceInterface
{
    /**
     * @param array $validatedData
     * @return array
     */
    public function registerAttempt(array $validatedData): User;

    /**
     * @param array $validatedData
     * @return array
     */
    public function registerConfirm(array $validatedData): User;

    /**
     * @param array $validatedData
     * @return array
     */
    public function loginAttempt(array $validatedData): User;

    /**
     * @param array $validatedData
     * @return array
     */
    public function loginConfirm(array $validatedData): User;

    /**
     * @param User $user
     * @return mixed
     */
    public function sendMail(User $user): void;


    /**
     * @param User $user
     * @return string
     */
    public function createCode(User $user): string;

    /**
     * @param User $code
     * @param User $code
     * @return bool
     */
    public function validateCode(string $code, User $user): bool;

    /**
     *
     */
    public function logout(): void;
}
