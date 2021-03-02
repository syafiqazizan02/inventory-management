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
Route::apiResource('/customer', 'API\Customer\CustomerController');

Route::post('/salary/pay-now/{id}', 'API\Salary\SalaryController@PayNow');
Route::get('/salary', 'API\Salary\SalaryController@AllSalary');
Route::get('/salary/view/{id}', 'API\Salary\SalaryController@ViewSalary');
Route::get('/salary/edit/{id}', 'API\Salary\SalaryController@EditSalary');
Route::put('/salary/update/{id}', 'API\Salary\SalaryController@SalaryUpdate');

Route::post('/stock/update/{id}', 'API\Product\ProductController@StockUpdate');
