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
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/auth-user', 'LoginController@authUser');
Route::get('/test-email', 'LoginController@emailTest');
Route::get('/generate-thumb/{height}/{width}/{original_url}', 'ImageOptimizeController@resize')->where('original_url', '.*');

Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/', 'LoginController@dashboard');
    Route::get('/users', 'LoginController@dashboard');
    Route::get('/get-block-data', 'DashboardController@getBlockData');
    Route::get('/get-students_new_uni', 'DashboardController@getstudents_new_uni');
    Route::get('/get-features_chart', 'DashboardController@getfeatures_chart');
    Route::get('/get-products_today', 'DashboardController@getproducts_today');
    Route::get('/get-events_today', 'DashboardController@getevents_today');

});
