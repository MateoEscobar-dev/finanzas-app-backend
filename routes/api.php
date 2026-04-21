<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\TwoFactorController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
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

    // Menú
    Route::get('/menu/hierarchical', [MenuController::class, 'hierarchical']);
    Route::get('/menu/by-system/{idSistema}', [MenuController::class, 'bySystem']);
    Route::apiResource('menu', MenuController::class);

    // Usuarios — CRUD + rutas adicionales
    Route::apiResource('users', UserController::class);
    Route::prefix('users')->group(function () {
        Route::post('{id}/activate',    [UserController::class, 'activate']);
        Route::post('{id}/deactivate',  [UserController::class, 'deactivate']);
        Route::get('{id}/history',      [UserController::class, 'history']);
        Route::post('{id}/language',    [UserController::class, 'language']);
        Route::get('{id}/permissions',  [UserController::class, 'getUserPermissions']);
        Route::post('{id}/permissions', [UserController::class, 'syncUserPermissions']);
        Route::post('{id}/roles',       [UserController::class, 'assignRoles']);
    });

    // Roles — CRUD + rutas adicionales
    Route::apiResource('roles', RoleController::class);
    Route::prefix('roles')->group(function () {
        Route::post('{id}/activate',    [RoleController::class, 'activate']);
        Route::post('{id}/deactivate',  [RoleController::class, 'deactivate']);
        Route::post('{id}/permissions', [RoleController::class, 'syncPermissions']);
    });

    // Permisos — solo lectura
    Route::get('/permissions',      [PermissionController::class, 'index']);
    Route::get('/permissions/{id}', [PermissionController::class, 'show']);
});
