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
Route::group(['middleware' => 'cors'], function () {

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
    Route::get('/device-token/{userid}/{token}', 'Api\UserController@updateDeviceToken');
    Route::get('/verify-email-token/{token}', 'Api\UserController@verifyEmailToken');
    Route::post('/send-verify-email/{user_id}', 'Api\UserController@sendVerifyEmail');

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

//contact
    Route::get('/contact', 'Api\ContactController@contacts');
    Route::post('/contact', 'Api\ContactController@create');
    Route::get('/contact/{id}', 'Api\ContactController@contact');
    Route::post('/contact/delete/{id}', 'Api\ContactController@delete');

//coupans
    Route::get('/coupans', 'Api\CoupanController@index');
    Route::post('/coupan', 'Api\CoupanController@create');
    Route::post('/coupan/{id}', 'Api\CoupanController@update');
    Route::post('/coupan/delete/{id}', 'Api\CoupanController@delete');

//favourite
    Route::post('/favourite', 'Api\FavouriteController@addAndRemove');
    Route::get('/user-favourite/{user_id}/{type}', 'Api\FavouriteController@userFavourites');
    Route::post('/favourite/delete/{id}', 'Api\FavouriteController@delete');

//product-Request
    Route::post('/product-request', 'Api\ProductRequestController@create');
    Route::get('/product-request', 'Api\ProductRequestController@list');
    Route::get('/product-request/user/{user_id}', 'Api\ProductRequestController@userlist');
    Route::post('/product-request/{id}', 'Api\ProductRequestController@update');
    Route::post('/product-request/delete/{id}', 'Api\ProductRequestController@delete');
    Route::get('/product-request/{id}', 'Api\ProductRequestController@request');

//forgot-password
    Route::post('/forgot-password', 'Api\UserController@forgotPassword');
    Route::post('/update-password', 'Api\UserController@updatePassword');
    Route::post('/reset-password', 'Api\UserController@resetPassword');

    // user visits
    Route::post('/user-visit', 'Api\UserVisitsController@create');

    // chat messages
    Route::get('/temp-dialog/', 'Api\ChatDialogController@tempDialog');
    Route::post('/update-open-status/{dialog_id}/{status}/{user_id}', 'Api\ChatDialogController@updateOpenStatus');
    Route::get('/dialog/{dialog_id}', 'Api\ChatDialogController@dialog');
    Route::post('/dialog/delete/{dialog_id}', 'Api\ChatDialogController@delete');
    Route::get('/dialogs/{user_id}', 'Api\ChatDialogController@userDialogs');

    Route::get('/messages/{dialog_id}', 'Api\ChatMessageController@messages');
    Route::post('/message/', 'Api\ChatMessageController@create');
    Route::get('/unread-message/{user_id}', 'Api\ChatMessageController@unreadMessage');
    Route::get('/mark-read-dialog/{dialog_id}/{user_id}', 'Api\ChatMessageController@markReadDialog');
    Route::post('/send-chat-message/{user_id}', 'Api\ChatMessageController@sendChatEmail');

// });
});
