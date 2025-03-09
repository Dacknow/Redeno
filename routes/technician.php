<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TechnicianController;

Route::get('/', function () {
    return 'hello technician';
});

Route::middleware(['guest:technician'])->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginFormTechnician')->name('t.login');
        Route::get('/forgot_password', 'forgotFormTechnician')->name('t.forgot');
    });
});

Route::middleware(['auth:tecnician'])->group(function(){
    Route::controller(TechnicianController::class)->group(function(){
        Route::get('/dashboard', 'TechnicianDashboard')->name('t.dashboard');
    });
});