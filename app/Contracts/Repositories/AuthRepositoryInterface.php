<?php

namespace App\Contracts\Repositories;

use App\Models\User;

/**
 * Interface AuthRepositoryInterface
 * @package App\Contracts\Repositories
 */
interface AuthRepositoryInterface
{
    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User;

    /**
     * @return User
     */
    public function findById($id): User;

    /**
     * @param $data
     * @return User
     */
    public function createUser($data): User;

    /**
     * @param $id
     * @return mixed
     */
    public function deleteUser($id);
}
