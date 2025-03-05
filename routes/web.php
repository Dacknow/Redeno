<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/**
 * TESTIN ROUTE
 */

Route::view('/example-page', 'example-page')->name('example-page');
Route::view('/example-auth', 'example-auth')->name('example-auth');