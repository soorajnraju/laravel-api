<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
#########################################################################
#Public Endpoints
#########################################################################
Route::post('v1/login', 'API\V1\UserController@login');
Route::post('v1/register', 'API\V1\UserController@register');
Route::get('v1/product/{id}', 'API\V1\ProductController@product');//all
Route::get('v1/category/{id}', 'API\V1\CategoryController@category');//all
#########################################################################
#Secured Endpoints
#########################################################################
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('v1/details', 'API\V1\UserController@details');
    Route::post('v1/logout', 'API\V1\UserController@logout');
    Route::post('v1/profile/create', 'API\V1\UserProfileController@create');
    Route::post('v1/profile', 'API\V1\UserProfileController@profile');
    Route::post('v1/product/create', 'API\V1\ProductController@create');
    Route::post('v1/category/create', 'API\V1\CategoryController@create');
    Route::put('v1/category/update/{id}', 'API\V1\CategoryController@update');
    Route::delete('v1/category/delete/{id}', 'API\V1\CategoryController@delete');
    Route::post('v1/cart/create', 'API\V1\CartController@create');
    Route::put('v1/cart/update/{id}', 'API\V1\CartController@update');
    Route::delete('v1/cart/delete/{id}', 'API\V1\CartController@delete');
    Route::get('v1/cart', 'API\V1\CartController@cart');//by user
    Route::get('v1/cart/all', 'API\V1\CartController@all');
});
