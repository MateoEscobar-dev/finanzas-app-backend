<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\TwoFactorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

// Fallback de autenticación
Route::get('/', [AuthController::class, 'login_fall'])->name('login');

// Rutas públicas con rate limiting para prevenir fuerza bruta
Route::middleware('throttle:5,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('throttle:3,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // 2FA
    Route::middleware('throttle:5,1')->group(function () {
        Route::post('/2fa/enable', [TwoFactorController::class, 'enable']);
        Route::post('/2fa/verify', [TwoFactorController::class, 'verify']);
    });

    // Menú rutas
    Route::get('/menu/hierarchical', [MenuController::class, 'hierarchical']);
    Route::get('/menu/by-system/{idSistema}', [MenuController::class, 'bySystem']);
    Route::apiResource('menu', MenuController::class);

    // Rutas de roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::get('/permissions', [RoleController::class, 'permissions']);

    // Rutas de usuarios
    Route::apiResource('user', UserController::class);
    Route::group(['prefix' => 'user'], function () {
        Route::post('{user}/activate', [UserController::class, 'activate']);
        Route::post('{user}/deactivate', [UserController::class, 'deactivate']);
        Route::get('{user}/history', [UserController::class, 'history']);
        Route::post('{user}/language', [UserController::class, 'language']);
    });
});

