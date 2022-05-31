<?php

namespace App\Providers;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /** @var array|string[] Список репозиториев для DI контейнера */
    public array $bindings = [
        AuthRepositoryInterface::class => AuthRepository::class
    ];
}
