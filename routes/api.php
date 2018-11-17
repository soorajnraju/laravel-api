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

Route::post('v1/login', 'API\V1\UserController@login');
Route::post('v1/register', 'API\V1\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('v1/details', 'API\V1\UserController@details');
    Route::post('v1/logout', 'API\V1\UserController@logout');
});
