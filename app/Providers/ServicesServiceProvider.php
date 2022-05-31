<?php

namespace App\Providers;

use App\Contracts\Services\AuthServiceInterface;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    /** @var array|string[] Список сервисов для регистрации в DI контейнере */
    public array $bindings = [
        AuthServiceInterface::class => AuthService::class
    ];
}
