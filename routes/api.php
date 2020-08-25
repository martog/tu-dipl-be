<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
], function ($router) {

    /* AuthController */
    Route::post('auth/login', 'AuthController@login')->withoutMiddleware('auth:api');
    Route::post('auth/logout', 'AuthController@logout');
    Route::post('auth/refresh', 'AuthController@refresh');


    /* UsersController */
    Route::post('user/register', 'UserController@register')->withoutMiddleware('auth:api');
    Route::put('user/update', 'UserController@updateCurrentUser');
    Route::delete('user/delete', 'UserController@deleteCurrentUser');


    /* DeviceController */
    Route::post('controller/add', 'DeviceController@addController');
    Route::delete('controller/remove', 'DeviceController@removeController');
});
