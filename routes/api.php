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

Route::apiResource('/employee', 'API\Employee\EmployeeController');
Route::apiResource('/supplier', 'API\Supplier\SupplierController');
Route::apiResource('/category', 'API\Category\CategoryController');
Route::apiResource('/product', 'API\Product\ProductController');
Route::apiResource('/expense', 'API\Expense\ExpenseController');


