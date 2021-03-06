<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth:api',
], function ($router) {

    /* AuthController */
    Route::post('auth/login', 'AuthController@login')->withoutMiddleware('auth:api');
    Route::post('auth/refresh', 'AuthController@refresh')->withoutMiddleware('auth:api');
    Route::post('auth/logout', 'AuthController@logout');


    /* UsersController */
    Route::get('user', 'UserController@getCurrentUser');
    Route::post('user/register', 'UserController@register')->withoutMiddleware('auth:api');
    Route::put('user/update', 'UserController@updateCurrentUser');
    Route::delete('user/delete', 'UserController@deleteCurrentUser');


    /* DeviceController */
    Route::post('controller/add', 'DeviceController@addController');
    Route::put('controller/{controllerId}/update', 'DeviceController@updateController');
    Route::get('controller/{controllerId}/devices', 'DeviceController@getDevices');
    Route::post('controller/{controllerId}/serial', 'DeviceController@getControllerSerialNumber');
    Route::delete('controller/{controllerId}/remove', 'DeviceController@removeController');
    Route::post('controller/devices/{device}/status/{status}', 'DeviceController@setDeviceStatus');
    Route::put('controller/devices/{device}/update', 'DeviceController@updateDevice');
    Route::get('controllers', 'DeviceController@getControllers');
    Route::get('controllers/search', 'DeviceController@searchController');
});
