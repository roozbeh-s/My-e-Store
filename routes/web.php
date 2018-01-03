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


Route::group(['middleware' => ['web']], function (){

	// Authentication Routes

	Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']); 
	Route::post('auth/login','Auth\LoginController@login');
	Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

	// Registeration Route 

	Route::post('auth/register','Auth\RegisterController@register');
	Route::get('auth/register',['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);


	Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
	Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
	Route::get('password/reset/{token?}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
	Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);


	Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getIndex']); 
	Route::get('contact','PagesController@getContact');
	

// After login 

Route::group(['middleware' => 'auth'], function () {

	//Account Management Routes
	Route::get('customer/account',['as' => 'account', 'uses' => 'AccountController@getAccount']);
	Route::get('customer/edit',['as' => 'accountedit', 'uses' => 'EditAccountController@getAccountEdit']);
	Route::patch('customer/edit',['as' => 'accountupdate', 'uses' => 'EditAccountController@update']);
	Route::get('customer/edit/password',['as' => 'passwordedit', 'uses' => 'EditAccountController@getPasswordEdit']);
	Route::patch('customer/edit/password',['as' => 'passwordupdate', 'uses' => 'EditAccountController@passwordupdate']);
	Route::get('customer/edit/address',['as' => 'addressedit', 'uses' => 'EditAccountController@getAddressEdit']);
	Route::post('customer/edit/address',['as' => 'addressupdate', 'uses' => 'EditAccountController@addressUpdate']);
	Route::get('checkout/deliveryinformation',['as' => 'checkout', 'uses' => 'CheckoutController@getCheckout']);
	Route::post('checkout/deliveryinformation',['as' => 'checkout', 'uses' => 'CheckoutController@addNewShippingAddress']);
	Route::get('checkout/paymentinformation',['as' => 'paymentinfo', 'uses' => 'CheckoutController@paymentInfo']);
	Route::post('checkout/createOrder',['as' => 'createorder', 'uses' => 'CheckoutController@createOrder']);
	Route::get('customer/orders',['as' => 'orders', 'uses' => 'OrderController@getOrders']);
	//Route::get('getorderswithstatus',['as' => 'getorderswithstatus', 'uses' => 'OrderController@getOrdersWithStatus']);
	Route::get('customer/orders/status',['as' => 'searchorder', 'uses' => 'OrderController@searchOrder']);
	Route::get('customer/orderdetail/{id}',['as' => 'orderdetail', 'uses' => 'OrderController@getOrderDetail'])->where('id', '[\w\d\-]+');
	Route::get('customer/rateproduct/product-id={product_id}&order-id={order_id}',['as' => 'rateproduct', 'uses' => 'ReviewController@getRatingDetail'])->where('product_id', '[\w\d\-]+')->where('order_id', '[\w\d\-]+');
	Route::post('customer/rateproduct/rating/{product_id}',['as' => 'rating', 'uses' => 'ReviewController@productRating']);
	Route::post('customer/rateproduct/ratingupdate/{product_id}',['as' => 'ratingupdate', 'uses' => 'ReviewController@productRatingUpdate']);

	Route::get('customer/review',['as' => 'review', 'uses' => 'ReviewController@getReview']);
	
});


	//Prouduct Routes

	Route::get('product',['as' => 'product', 'uses' => 'ProductController@getProduct']);
	
	//Product Details

	Route::get('productdetail/{sku}/{id}',['as' => 'productdetail', 'uses' => 'ProductController@getProductDetail'])->where('sku', '[\w\d\-]+');
	
	//Shopping Cart
	route::post('addtocart/{sku}/{id}',['as' => 'addtocart', 'uses' => 'CartController@AddToCart']);
	route::get('cart',['as' => 'cart', 'uses'=> 'CartController@getCart' ]);

	
	route::get('removefromcart/{rowId}',['as' => 'removefromcart', 'uses'=> 'CartController@removeFromCart']);
	route::post('increaseproduct/{rowId}',['as' => 'increaseproduct', 'uses'=> 'CartController@increaseProductQuantity']);
	route::post('updateoption/{rowId}',['as' => 'updateoption', 'uses'=> 'CartController@updateProductOption']);
	route::get('editoption/{rowId}',['as' => 'editoption', 'uses'=> 'CartController@editoption']);

	//Product Search

	Route::get('productsearch',['as' => 'productsearch', 'uses' => 'ProductController@ProductSearch']);

	//Product Category 

	Route::get('/{category}',['as' => 'getproductbycategory', 'uses' => 'ProductController@getProductByCategory']);

	//Product by Category and Price Range



	Route::get('/{category}/price',['as' => 'getproductbycategoryandPrice', 'uses' => 'ProductController@getproductbycategoryandPrice']);




});


