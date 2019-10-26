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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth', 'auto-check-permission']], function(){

	
	Route::resource('neighborhoods', 'NeighborhoodController');
	Route::resource('cities', 'CityController');
	Route::resource('categories', 'CategoryController');
	Route::resource('settings', 'SettingController');
	Route::resource('payment-methods', 'PaymentMethodController');
	Route::resource('restaurants', 'RestaurantController');
	Route::resource('restaurant-payments', 'RestaurantPaymentController');
	Route::resource('orders', 'OrderController');
	Route::resource('offers', 'OfferController');
	Route::get('/contacts', 'ContactController@index');
	Route::delete('/contacts/{contact}', 'ContactController@destroy');
	Route::get('/clients', 'ClientController@index');
	Route::delete('/clients/{client}', 'ClientController@destroy');
	Route::get('client/{id}/activate', 'ClientController@activate');
	Route::get('client/{id}/de-activate', 'ClientController@deActivate');
	Route::get('restaurant/{id}/activate', 'RestaurantController@activate');
	Route::get('restaurant/{id}/de-activate', 'RestaurantController@deActivate');
	Route::resource('roles', 'RoleController');

	Route::resource('users', 'UserController');
	Route::get('user-password/change-password', 'UserController@changePassword');
	Route::put('user-password/change-password', 'UserController@changePasswordSave');
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
});

