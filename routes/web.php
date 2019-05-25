<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/customers/header', 'CustomersController@GetCustomersHeader');
Route::get('/customers/modal_view', 'CustomersController@GetAddCustomerModal');
Route::get('/customers', 'CustomersController@GetAll');

//Single Customer
//Add Customer
Route::post('/customers/addcustomer', 'SingleCustomerController@AddCustomer');
Route::get('/singlecustomer', 'SingleCustomerController@ShowSingleCustomer');
Route::get('/singlecustomer/getTabs', 'SingleCustomerController@getTabs');
