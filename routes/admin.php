<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubdomainController;
use App\Http\Controllers\RoleController;

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
        Route::get('/users', 'usersPage')->middleware('permission:users.index,admin')->name('users.index');
        Route::get('/users/edit-technician/{technician}', 'editTechnicianForm')->middleware('permission:users.edit-technician,admin')->name('users.edit-technician');
        Route::put('/users/update-technician/{technician}', 'updateTechnician')->name('users.update-technician');
        Route::get('/users/edit-admin/{admin}', 'editAdminForm')->middleware('permission:users.edit-admin,admin')->name('users.edit-admin');
        Route::put('/users/update-admin/{admin}', 'updateAdmin')->name('users.update-admin');
        Route::get('/users/create-admin', 'createAdminForm')->middleware('permission:users.create-admin,admin')->name('users.create-admin');
        Route::post('/users/store-admin', 'storeAdmin')->name('users.store-admin');
    });
    
    Route::get('/templates', [SubdomainController::class,'templatesPage'])->middleware('permission:templates.index,admin')->name('templates-page');
    
    Route::get('/manage-reports', [ReportController::class,'manageReportPage'])->middleware('permission:manage-reports,admin')->name('manage-reports');

    Route::controller(RoleController::class)->group(function () {
        Route::get('/roles', 'index')->middleware('permission:roles.index,admin')->name('roles.index');
        Route::get('/roles/create', 'create')->middleware('permission:roles.create,admin')->name('roles.create');
        Route::post('/roles/store', 'store')->name('roles.store');
        Route::get('/roles/edit/{role}', 'edit')->middleware('permission:roles.edit,admin')->name('roles.edit');
        Route::put('/roles/update/{role}', 'update')->name('roles.update');
        Route::delete('/roles/destroy/{role}', 'destroy')->middleware('permission:roles.destroy,admin')->name('roles.destroy');

    });
    
    Route::get('/history', [ReportController::class, 'historyPage'])->middleware('permission:history,admin')->name('history');
});