<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Authore@index');
Route::post('/auth','Authore@login');

Route::group(['prefix' => 'admin'], function () {
    Route::post('reguser','Admin@reguser');
    Route::post('reg_group','Admin@addgroup');
    Route::get('/','Admin@mainadm');

});


