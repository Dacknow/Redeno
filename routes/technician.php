<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TechnicianController;

Route::get('/', function () {
    return 'hello technician';
});

Route::middleware(['guest:technician'])->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginFormTechnician')->name('tLogin');
        Route::post('/login_handler', 'loginHandlerTechnician')->name('tLogin_handler');
        Route::get('/forgot_password', 'forgotFormTechnician')->name('tForgot');
    });
});

Route::middleware(['auth:technician'])->group(function(){
    Route::controller(TechnicianController::class)->group(function(){
        Route::get('/dashboard', 'TechnicianDashboard')->name('tDashboard');
    });
});