<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TechnicianController;

Route::get('/', function () {
    return 'hello technician';
});

Route::middleware(['guest', 'preventBackHistory'])->group(function(){
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginFormTechnician')->name('tLogin');
        Route::post('/login-handler', 'loginHandlerTechnician')->name('tLogin-handler');
        Route::get('/forgot-password', 'forgotFormTechnician')->name('tForgot-password');
        Route::get('/register', 'registerFormTechnician')->name('tRegister');
    });

    Route::controller(TechnicianController::class)->group(function (){
        Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('tSend-password-reset-link');
        Route::get('/password/reset/{token}', 'resetPassword')->name('tReset-password');
        Route::post('/reset-password-handler', 'resetPasswordHandler')->name('tReset-password-handler');
        Route::post('/register-handler', 'registerHandler')->name('tRegister-handler');        
        Route::get('/email-validated/{technician}',[TechnicianController::class, 'emailValidated'])->name('tEmail-validated');
    });
});

Route::middleware(['auth', 'preventBackHistory'])->group(function(){
    Route::controller(TechnicianController::class)->group(function(){
        Route::get('/home', 'home')->name('home');
        Route::post('/logout-handler', 'logoutHandler')->name('tLogout-handler');        
        Route::get('/profile', 'profileView')->name('tProfile');
        Route::post('/update-profile-picture', 'updateProfilePicture')->name('tUpdate_profile_picture');
    });
});