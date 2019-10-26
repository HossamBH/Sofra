<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1', 'namespace' => 'Api'],function(){
	Route::get('neighborhoods','MainController@neighborhoods');
	Route::get('cities','MainController@cities');
	Route::get('categories','MainController@categories');
	Route::get('products','MainController@products');
	Route::post('reviews','MainController@reviews');
	Route::post('about-restaurant','MainController@aboutRestaurant');
	Route::get('contact-us','MainController@contacts');
	Route::get('offers','MainController@offers');
	Route::get('settings','MainController@settings');	
	Route::post('restaurants','MainController@restaurants');
	Route::get('payment-methods','MainController@paymentMethod');

	Route::group(['prefix' => 'restaurant', 'namespace' => 'Restaurant'],function(){
		Route::post('signup','AuthController@signup');
		Route::post('login','AuthController@login');
		Route::post('reset-password','AuthController@resetPassword');
		Route::post('new-password','AuthController@newPassword');

		Route::group(['middleware' => 'auth:restaurant'],function(){
			Route::post('register-token','AuthController@registerToken');
			Route::post('remove-token','AuthController@removeToken');
			Route::post('profile','MainController@profile');
			Route::post('edit-profile','MainController@editProfile');
			Route::get('show-products','MainController@showProducts');
			Route::post('create-product','MainController@createProduct');
			Route::post('edit-product','MainController@editProduct');
			Route::post('delete-product','MainController@deleteProduct');
			Route::post('show-offers','MainController@showOffers');
			Route::post('create-offer','MainController@createOffer');
			Route::post('edit-offer','MainController@editOffer');
			Route::post('delete-offer','MainController@deleteOffer');
			Route::post('past-orders','MainController@pastOrders');
			Route::post('current-orders','MainController@currentOrders');
			Route::post('new-orders','MainController@newOrders');
			Route::post('accepted-orders','MainController@acceptedOrders');
			Route::post('rejected-orders','MainController@rejectedOrders');
			Route::get('settings','MainController@settings');

			Route::post('get-notification-setting','MainController@getNotificationSetting');
			Route::post('set-notification-setting','MainController@setNotificationSetting');
		});
	});

	Route::group(['prefix' => 'client', 'namespace' => 'Client'],function(){
		Route::post('signup','AuthController@signup');
		Route::post('login','AuthController@login');
		Route::post('reset-password','AuthController@resetPassword');
		Route::post('new-password','AuthController@newPassword');

		Route::group(['middleware' => 'auth:client'],function(){
			Route::post('register-token','AuthController@registerToken');
			Route::post('remove-token','AuthController@removeToken');
			Route::post('profile','MainController@profile');
			Route::post('edit-profile','MainController@editProfile');
			Route::post('add-review','MainController@addReview');
			Route::post('new-order','MainController@newOrder');
			Route::post('order-details','MainController@orderDetails');
			Route::post('past-orders','MainController@pastOrders');
			Route::post('current-orders','MainController@currentOrders');
			Route::post('declined-orders','MainController@declinedOrders');
			Route::post('delivered-orders','MainController@deliveredOrders');


			Route::post('get-notification-setting','MainController@getNotificationSetting');
			Route::post('set-notification-setting','MainController@setNotificationSetting');
		});
	});
});