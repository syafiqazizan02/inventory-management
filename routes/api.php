<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'API\Auth\AuthController@login');
    Route::post('register', 'API\Auth\AuthController@register');
    Route::post('logout', 'API\Auth\AuthController@logout');
    Route::post('refresh', 'API\Auth\AuthController@refresh');
    Route::post('me', 'API\Auth\AuthController@me');

});
