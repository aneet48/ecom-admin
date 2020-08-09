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

/*
|--------------------------------------------------------------------------
| Global routes
|--------------------------------------------------------------------------
|
 */

// users
Route::post('/user/sign-up', 'Api\UserController@signUp');
Route::post('/user/simple-sign-up', 'Api\UserController@simpleSignUp');
Route::post('/user/google-sign-up', 'Api\UserController@googleSimpleSignUp');
Route::post('/user/login', 'Api\UserController@login');
Route::get('/test', 'Api\UserController@test');

// universities

/*
|--------------------------------------------------------------------------
| Auth  routes
|--------------------------------------------------------------------------
|
 */

Route::get('/universities/global/search/{q}', 'Api\UniversityController@searchGlobal');

/*
|--------------------------------------------------------------------------
| Admin  routes
|--------------------------------------------------------------------------
|

 */

// Route::middleware(['auth:api'])->group(function () {
// cities
Route::get('/cities/{show_all?}', 'Api\CityController@cities');
Route::get('/city/{id}', 'Api\CityController@city');
Route::post('/city', 'Api\CityController@create');
Route::post('/city/{id}', 'Api\CityController@update');
Route::post('/city/delete/{id}', 'Api\CityController@delete');
Route::get('/cities/search/{q}', 'Api\CityController@search');

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
Route::get('/universities/search/{q}', 'Api\UniversityController@search');
Route::get('/all-universities', 'Api\UniversityController@alluniversities');
Route::post('/universities/import', 'Api\UniversityController@import');

// users

Route::get('/users', 'Api\UserController@users');
Route::get('/user/{id}', 'Api\UserController@user');
Route::post('/user/update/{id}', 'Api\UserController@update');
Route::post('/user/delete/{id}', 'Api\UserController@delete');
Route::get('/user/search/{q}', 'Api\UserController@search');
Route::post('/profile-img/update', 'Api\UserController@profileImgUpdate');

// products
Route::get('/products/{show_all?}', 'Api\ProductController@products');
Route::get('/product/{id}', 'Api\ProductController@product');
Route::post('/product', 'Api\ProductController@create');
Route::post('/product/{id}', 'Api\ProductController@update');
Route::post('/product/delete/{id}', 'Api\ProductController@delete');
Route::get('/products/search/{q}', 'Api\ProductController@search');

// product-categories
Route::get('/product-categories/{show_all?}/{cat_id?}', 'Api\ProductCategoryController@list');
Route::get('/product-category/{id}', 'Api\ProductCategoryController@productCategory');
Route::post('/product-category', 'Api\ProductCategoryController@create');
Route::post('/product-category/{id}', 'Api\ProductCategoryController@update');
Route::post('/product-category/delete/{id}', 'Api\ProductCategoryController@delete');
Route::get('/product-categories-search/{q}', 'Api\ProductCategoryController@search');

// product Images
Route::post('/product-media', 'Api\ProductMediaController@create');
Route::post('/product-media/delete/{id}', 'Api\ProductMediaController@delete');
Route::get('/product-media/{product_id}', 'Api\ProductMediaController@productMedias');
Route::post('/product-media-base64', 'Api\ProductMediaController@productMediasBase64');

// events
Route::get('/events/{show_all?}', 'Api\EventController@events');
Route::get('/event/{id}', 'Api\EventController@event');
Route::post('/event', 'Api\EventController@create');
Route::post('/event/{id}', 'Api\EventController@update');
Route::post('/event/delete/{id}', 'Api\EventController@delete');
Route::get('/events/search/{q}', 'Api\EventController@search');

// event-categories
Route::get('/event-categories/{show_all?}/{cat_id?}', 'Api\EventCategoryController@list');
Route::get('/event-category/{id}', 'Api\EventCategoryController@eventCategory');
Route::post('/event-category', 'Api\EventCategoryController@create');
Route::post('/event-category/{id}', 'Api\EventCategoryController@update');
Route::post('/event-category/delete/{id}', 'Api\EventCategoryController@delete');
Route::get('/event-categories-search/{q}', 'Api\EventCategoryController@search');

// event Images
Route::post('/event-media', 'Api\EventMediaController@create');
Route::post('/event-media/delete/{id}', 'Api\EventMediaController@delete');
Route::get('/event-media/{event_id}', 'Api\EventMediaController@eventMedias');
Route::post('/event-media-base64', 'Api\EventtMediaController@eventMediasBase64');

// settings
Route::post('/setting/store', 'SettingController@store');
Route::get('/setting/search/{meta_key}/{group}', 'SettingController@search');

// orders
Route::post('/order', 'OrderController@create');

//feedback
Route::get('/all-feedback', 'Api\FeedbackController@all');
Route::get('/feedback', 'Api\FeedbackController@index');
Route::post('/feedback', 'Api\FeedbackController@create');
Route::post('/feedback/{id}', 'Api\FeedbackController@update');
Route::post('/feedback/delete/{id}', 'Api\FeedbackController@delete');

//coupans
Route::get('/coupans', 'Api\CoupanController@index');
Route::post('/coupan', 'Api\CoupanController@create');
Route::post('/coupan/{id}', 'Api\CoupanController@update');
Route::post('/coupan/delete/{id}', 'Api\CoupanController@delete');
// });
