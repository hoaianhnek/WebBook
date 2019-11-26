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

Route::get('/', function () {
    return view('welcome');
});

 Route::prefix('bookstore')->group(function(){
	 	// Route::post('','UsersController@getLogin');
        Route::get('master-{body}','HomepageController@getBody');
        Route::get('showcart','CartController@show_cart');
        Route::post('showcart','CartController@savecart');
        Route::get('deletecart-{rowId}','CartController@deletecart');
        Route::get('qty-cart', 'CartGetController@getQtyCart');
        Route::post('add-customer','CheckoutController@add_customer');

        Route::get('login-checkout','CheckoutController@login_checkout');
        Route::post('register','CheckoutController@postLogin');
    });