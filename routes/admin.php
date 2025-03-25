<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubdomainController;

Route::get('/', function () {
    return 'hello admin';
});


// Rutas para usuarios no autenticados (guest)
Route::middleware('guest', 'preventBackHistory')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'loginForm')->name('login');
        Route::post('/login-handler', 'loginHandler')->name('login-handler');
        Route::get('/forgot-password', 'forgotForm')->name('forgot-password');
    });

    Route::controller(AdminController::class)->group(function (){
        Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send-password-reset-link');
        Route::get('/password/reset/{token}', 'resetPassword')->name('reset-password');
        Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset-password-handler');
        
    });
});

// Rutas para usuarios autenticados (auth)
Route::middleware('auth', 'preventBackHistory')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::post('/logout-handler', 'logoutHandler')->name('logout-handler');
        Route::get('/profile', 'profileView')->name('profile');
        Route::post('/update-profile-picture', 'updateProfilePicture')->name('update_profile_picture');
        Route::get('/users', 'usersPage')->name('users');
        Route::get('/users/edit-technician/{technician}', 'editTechnicianForm')->name('users.edit-technician');
        Route::put('/users/update-technician/{technician}', 'updateTechnician')->name('users.update-technician');
        Route::get('/users/edit-admin/{admin}', 'editAdminForm')->name('users.edit-admin');
        Route::put('/users/update-admin/{admin}', 'updateAdmin')->name('users.update-admin');
        Route::get('/users/create-admin', 'createAdminForm')->name('users.create-admin');
        Route::post('/users/store-admin', 'storeAdmin')->name('users.store-admin');
    });
    Route::controller(SubdomainController::class)->group(function () {
        Route::get('/templates', 'templatesPage')->name('templates-page');
    });
});