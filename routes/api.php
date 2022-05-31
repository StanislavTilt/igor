<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login-attempt', [AuthController::class, 'loginAttempt']);
    Route::post('login-confirm', [AuthController::class, 'loginConfirm']);

    Route::post('register-attempt', [AuthController::class, 'registerAttempt']);
    Route::post('register-confirm', [AuthController::class, 'registerConfirm']);

    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
