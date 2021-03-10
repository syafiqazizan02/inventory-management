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

Route::post('/salary/pay/{id}', 'API\Salary\SalaryController@PaySalary');
Route::get('/salary', 'API\Salary\SalaryController@AllSalary');
Route::get('/salary/view/{id}', 'API\Salary\SalaryController@ViewSalary');
Route::get('/salary/edit/{id}', 'API\Salary\SalaryController@EditSalary');
Route::put('/salary/update/{id}', 'API\Salary\SalaryController@SalaryUpdate');

Route::post('/stock/update/{id}', 'API\Product\ProductController@StockUpdate');

Route::get('/pos/get-product/{id}', 'API\Pos\PosController@GetProduct');
Route::post('/pos/order-complete', 'API\Pos\PosController@OrderComplete');

Route::get('/cart/add-to-cart/{id}', 'API\Cart\CartController@AddToCart');
Route::get('/cart/cart-product', 'API\Cart\CartController@CartProduct');
Route::get('/cart/remove-product/{id}', 'API\Cart\CartController@RemoveProduct');
Route::get('/cart/increment/{id}', 'API\Cart\CartController@Increment');
Route::get('/cart/decrement/{id}', 'API\Cart\CartController@Decrement');
Route::get('/cart/discount', 'API\Cart\CartController@Discount');

Route::get('/order/order-views', 'API\Order\OrderController@OrderViews');
Route::get('/order/order-infos/{id}', 'API\Order\OrderController@OrderInfos');
Route::get('/order/order-details/{id}', 'API\Order\OrderController@OrderDetails');
Route::post('/order/order-search', 'API\Order\OrderController@SearchOrderDate');
