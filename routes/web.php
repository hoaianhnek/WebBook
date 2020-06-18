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

        //Đăng nhập và xử lý đăng nhập
        Route::get('cart-add-{idBook}', 'Auth\LoginController@index');
        Route::get('login','Auth\LoginController@getLogin');
        Route::post('login','Auth\LoginController@postLogin');
        Route::post('register','Auth\LoginController@register');

        //tìm kiếm sách
        Route::get('searchAjax','HomepageController@searchAjax');

        // Đăng xuất
        Route::get('logout', 'Auth\LoginController@getLogout');
        Route::get('checkout-view','CartController@checkout');
        Route::get('loadShip','CartController@ship');
        Route::post('checkout-{cusID}','CartController@postCheckout');
    });
 Route::prefix('admin')->group(function(){
    Route::get('dashboard',function(){
        return view('admin.v_admin_dashboard');
    });

    Route::get('add-book','AdminBookController@viewaddBook');
    Route::get('book-view','AdminBookController@viewBook');
    Route::post('book-view-filter','AdminBookController@filterbook');
    Route::post('add-book','AdminBookController@addBook');
    Route::get('delete-{bookid}','AdminBookController@deleteBook');
    Route::get('update-{bookid}','AdminBookController@showupdateBook');
    Route::post('update-book-{bookid}','AdminBookController@updateBook');
    Route::get('load-Book-Ajax','AdminBookController@loadBookAjax');


    Route::get('category-view','AdminCategoryController@viewCategory');
    Route::post('add-category','AdminCategoryController@addCategory');
    Route::get('category-delete-{categoryid}','AdminCategoryController@deleteCategory');
    Route::get('category-update-view-{categoryid}','AdminCategoryController@viewAddCategory');
    Route::post('category-update-{categoryid}','AdminCategoryController@updateCategory');


    Route::get('customer-view','AdminCustomerController@viewCustomer');
    Route::get('customer-view-add','AdminCustomerController@viewAddCustomer');
    Route::post('customer-add','AdminCustomerController@addCustomer');
    Route::get('customer-edit-view-{cusID}','AdminCustomerController@customerEditView');
    Route::get('customer-load-ajax','AdminCustomerController@customerloadAjax');
    Route::post('customer-edit-{cusID}','AdminCustomerController@customerEdit');
    Route::get('customer-delete-{cusID}','AdminCustomerController@customerDelete');

    Route::get('ship-view','AdminShippingController@shipView');
    Route::post('ship-add','AdminShippingController@shipAdd');
    Route::get('shipping-delete-{shipID}','AdminShippingController@shipDelete');
    Route::get('shipping-edit-show-{shipID}','AdminShippingController@shipEditView');
    Route::post('shipping-edit-{shipID}','AdminShippingController@shipEdit');

    Route::get('discount-view','AdminDiscountController@discountView');
    Route::get('discount-add-view','AdminDiscountController@discountAddView');
    Route::post('discount-add','AdminDiscountController@discountAdd');
    Route::get('discount-edit-view-{disID}','AdminDiscountController@discountViewEdit');
    Route::post('discount-edit-{disID}','AdminDiscountController@discountEdit');
    Route::get('discount-delete-{disID}','AdminDiscountController@discountDelete');
    Route::get('loadDiscount','AdminDiscountController@loadDiscount');

    Route::get('order-view','AdminOrderController@orderView');
    Route::post('order-invoice-{orderID}','AdminOrderController@invoice');
    Route::post('order-filter','AdminOrderController@orderfilter');

    Route::get('report-month','adminReportController@reportmonth');
    Route::post('report-year','adminReportController@reportyear');

    Route::get('login','AdminLoginController@viewLogin');
    Route::get('logout','AdminLoginController@logoutAdmin');
    Route::get('register','AdminLoginController@viewRegister');
    Route::post('add-user','AdminLoginController@loginAdmin');
    //nhân viên
    Route::get('employ-show','AdminEmployController@viewEmploy');
    Route::get('show-employ-add','AdminEmployController@viewEmployAdd');
    Route::post('employ-add','AdminEmployController@addEmploy');
    Route::get('employ-edit-view-{idUser}','AdminEmployController@employedit');
    Route::post('update-employ-{id}','AdminEmployController@employupdate');
    Route::get('employ-delete-{id}','AdminEmployController@employDelete');
 });
 
