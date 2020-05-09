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

    // users
    Route::post('/user/sign-up', 'Api\UserController@signUp');
    Route::get('/users', 'Api\UserController@users');
    Route::get('/user/{id}', 'Api\UserController@user');
    Route::post('/user/update/{id}', 'Api\UserController@update');
    Route::post('/user/delete/{id}', 'Api\UserController@delete');

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
    Route::post('/product-images', 'Api\ProductImageController@create');
    Route::post('/product-images/delete/{id}', 'Api\ProductImageController@delete');
    Route::get('/product-images/{product_id}', 'Api\ProductImageController@productImages');


// });
