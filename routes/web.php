<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReportController;

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

Route::resource(name: 'products', controller: ProductController::class);
Route::resource(name: 'tags', controller: TagController::class);
Route::get('/reports/tags', [ReportController::class, 'tags'])->name('reports.tags');

Route::get('/clear-cache', function() {
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    return "Cache cleared";
});