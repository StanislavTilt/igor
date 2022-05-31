<?php

namespace App\Repositories;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Models\User;

/**
 * Class AuthRepository
 * @package App\Repositories
 */
class AuthRepository implements AuthRepositoryInterface
{
    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User
    {
        return User::where('email',$email)->firstOrFail();
    }

    /**
     * @return User
     */
    public function findById($id): User
    {
        return User::find($id);
    }

    /**
     * @param $data
     * @return User
     */
    public function createUser($data): User
    {
        return User::create($data);
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function deleteUser($id)
    {
        User::where('id',$id)->delete();
    }
}
