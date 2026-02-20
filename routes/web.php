<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('welcome');
})->name('root');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::get('/sessions/live', [SessionController::class, 'liveSessions'])->name('sessions.live');
    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');

    Route::get('/clear-cache', function () {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        return 'Cache cleared';
    });
});