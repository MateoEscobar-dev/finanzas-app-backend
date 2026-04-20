<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login_fall'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

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
        // Rutas adicionales de usuario
        Route::post('{user}/activate', [UserController::class, 'activate']);
        Route::post('{user}/deactivate', [UserController::class, 'deactivate']);
        Route::get('{user}/history', [UserController::class, 'history']);
        Route::post('{user}/language', [UserController::class, 'language']);
    });
});
