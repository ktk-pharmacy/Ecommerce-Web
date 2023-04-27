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

Route::group(['prefix' => 'auth'], function () {
    // API Version V1 Routes
    Route::group(['prefix' => 'v1', 'namespace' => 'Api\Auth\v1'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('request-otp', 'AuthController@requestOTP');
        Route::post('validation-otp', 'AuthController@validationOTP');

        Route::group(['middleware' => ['auth:customer']], function () {
            // Auth
            Route::post('logout', 'AuthController@logout');
            Route::post('change-password', 'AuthController@changePassword');
            Route::post('profile', 'AuthController@updateProfile');
            Route::get('profile', 'AuthController@getProfile');
            Route::post('deactivate', 'AuthController@deactivate');
        });
    });
});

Route::group(['prefix' => 'v1','namespace' => 'Api\v1','middleware' => ['auth:customer']], function () {
    // API Version V1 Routes
    //
    Route::get('categories', 'CategoryController@index');
    Route::get('categories/{id}/products', 'CategoryController@getProductsByCategory');
    Route::get('products', 'ProductController@index');
    Route::get('products/{id}', 'ProductController@show');
    Route::get('products/{slug}', 'ProductController@showSlug');
    Route::get('products/{id}/galleries', 'ProductController@getGalleries');

    Route::get('carts', 'CartController@index');
    Route::post('carts/{product_id}', 'CartController@store');
    Route::post('checkout', 'CheckoutController@checkout');
    Route::post('coupons/{name}/check', 'CheckoutController@validateCoupon');

    Route::get('orders', 'OrderController@index');
    Route::get('orders/{id}', 'OrderController@show');

    Route::get('locations', 'LocationController@index');
    Route::get('sliders', 'MobileAdvertisementController@index');

    Route::get('blogs', 'BlogController@index');
    Route::get('blogs/{id}', 'BlogController@show');

    Route::get('logistics', 'LogisticController@index');
});

Route::group(['prefix' => 'v2','namespace' => 'Api\v2','middleware' => ['auth:customer']], function () {
    Route::post('carts/{product_id}', 'CartController@store');
});
