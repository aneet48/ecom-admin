<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', 'LoginController@index');
Route::get('/states/{show_all?}', 'Api\StateController@states');
Route::get('/state/{id}', 'Api\StateController@state');
Route::post('/state', 'Api\StateController@create');
Route::post('/state/{id}', 'Api\StateController@update');
Route::post('/state/delete/{id}', 'Api\StateController@delete');
