<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TechnicianController;

Route::get('/', function () {
    return 'hello technician';
});

Route::middleware([])->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginFormTechnician')->name('loginT');
        Route::get('/forgot-password', 'forgotFormTechnician')->name('forgotT');
    });
});

Route::middleware([])->group(function(){
    Route::controller(TechnicianController::class)->group(function(){
        Route::get('/dashboard', 'TechnicianDashboard')->name('dashboardT');
    });
});