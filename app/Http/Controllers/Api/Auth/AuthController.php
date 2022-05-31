<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Services\AuthServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAttemptRequest;
use App\Http\Requests\Auth\LoginConfirmRequest;
use App\Http\Requests\Auth\RegisterAttemptRequest;
use App\Http\Requests\Auth\RegisterConfirmRequest;
use App\Http\Resources\Auth\AttemptResource;
use App\Http\Resources\Auth\LoginResource;

/**
 * Class AuthController
 * @package App\Http\Controllers\Api\Auth
 */
class AuthController extends Controller
{
    protected AuthServiceInterface $service;

    /**
     * AuthController constructor.
     * @param AuthServiceInterface $service
     */
    public function __construct(AuthServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param LoginAttemptRequest $request
     * @return AttemptResource
     */
    public function loginAttempt(LoginAttemptRequest $request)
    {
        $user = $this->service->loginAttempt($request->validated());
        return AttemptResource::make($user);
    }

    /**
     * @param LoginConfirmRequest $request
     * @return LoginResource
     */
    public function loginConfirm(LoginConfirmRequest $request)
    {
        $user = $this->service->loginConfirm($request->validated());
        return LoginResource::make($user);
    }

    /**
     * @param RegisterAttemptRequest $request
     * @return AttemptResource
     */
    public function registerAttempt(RegisterAttemptRequest $request)
    {
        $user = $this->service->registerAttempt($request->validated());
        return AttemptResource::make($user);
    }

    /**
     * @param RegisterConfirmRequest $request
     * @return LoginResource
     */
    public function registerConfirm(RegisterConfirmRequest $request)
    {
        $user = $this->service->registerConfirm($request->validated());
        return LoginResource::make($user);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->service->logout();
        return \response()->noContent();
    }
}
