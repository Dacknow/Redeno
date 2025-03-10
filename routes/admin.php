<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return 'hello admin';
});


// Rutas para usuarios no autenticados (guest)
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginForm')->name('login');
        Route::post('/login_handler', 'loginHandler')->name('login_handler');
        Route::get('/forgot_password', 'forgotForm')->name('forgot');
    });
});

// Rutas para usuarios autenticados (auth)
Route::middleware('auth')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/logout_handler', 'logoutHandler')->name('logout_handler');
    });
});