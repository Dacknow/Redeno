<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return 'hello admin';
});


// Rutas para usuarios no autenticados (guest)
Route::middleware(['guest:admin'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginForm')->name('login');
        Route::post('/login_handler', 'loginHandler')->name('admin.login_handler');
        Route::get('/forgot_password', 'forgotForm')->name('admin.forgot');
    });
});

// Rutas para usuarios autenticados (auth)
Route::middleware(['auth:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'AdminDashboard')->name('dashboard');
    });
});