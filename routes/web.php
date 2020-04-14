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

Route::get('/login', 'LoginController@index')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@login')->name('login.check')->middleware('guest');

Route::middleware(['web', 'auth'])->group(function () {

   Route::get('/', 'LoginController@dashboard');
   Route::get('/users', 'LoginController@dashboard');


});
