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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

	Route::resource('users','UsersController');
	Route::get('profile','UsersController@profile')->name('profile');
	Route::put('update_profile','UsersController@update_profile')->name('update_profile');
	Route::put('update_password','UsersController@update_password')->name('update_password');

	Route::resource('business','BusinessController');
	Route::resource('product_types','ProductTypesController');
	Route::resource('hotels','HotelsController');
	Route::resource('coupons','CouponsController');
	Route::resource('products','ProductsController');
	Route::resource('promotions','PromotionsController');
	
});
