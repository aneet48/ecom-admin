<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

 Route::get('/cities/search/{q}', 'Api\CityController@search');

Route::middleware(['auth:api'])->group(function () {
    // cities
    Route::get('/cities/{show_all?}', 'Api\CityController@cities');
    Route::get('/city/{id}', 'Api\CityController@city');
    Route::post('/city', 'Api\CityController@create');
    Route::post('/city/{id}', 'Api\CityController@update');
    Route::post('/city/delete/{id}', 'Api\CityController@delete');

    // states
    Route::get('/states/{show_all?}', 'Api\StateController@states');
    Route::get('/state/{id}', 'Api\StateController@state');
    Route::post('/state', 'Api\StateController@create');
    Route::post('/state/{id}', 'Api\StateController@update');
    Route::post('/state/delete/{id}', 'Api\StateController@delete');

    // universities
    Route::get('/universities/{show_all?}', 'Api\UniversityController@universities');
    Route::get('/university/{id}', 'Api\UniversityController@university');
    Route::post('/university', 'Api\UniversityController@create');
    Route::post('/university/{id}', 'Api\UniversityController@update');
    Route::post('/university/delete/{id}', 'Api\UniversityController@delete');

});
