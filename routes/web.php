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



/*
 =======================
    Dashboard Routes
==========================
 */

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//category routes
Route::resource('category', 'CategoryController');
Route::post('category/{id}/restore', 'CategoryController@restore')->name('category.restore');
Route::delete('category/{id}/delete', 'CategoryController@delete')->name('category.delete');

//service routes
Route::resource('service', 'ServiceController');
Route::post('service/{id}/restore', 'ServiceController@restore')->name('service.restore');
Route::delete('service/{id}/delete', 'ServiceController@delete')->name('service.delete');

//team routes
Route::resource('team','TeamController');
Route::post('team/{id}/restore','TeamController@restore')->name('team.restore');
Route::delete('team/{id}/delete','TeamController@delete')->name('team.delete');

//Admin Routes
Route::resource('user', 'UserController');
Route::post('user/{id}/restore', 'UserController@restore')->name('user.restore');
Route::delete('user/{id}/delete', 'UserController@delete')->name('user.delete');
Route::get('profile', 'UserController@show')->name('user.info');

//Customer Route
Route::get('customers', 'UserController@customer')->name('customer');


//Privacy & Policy
route::group(['prefix' => 'setting/privacy'], function () {
    Route::get('/', 'PrivacyController@index')->name('privacy.index');
    Route::post('/store', 'PrivacyController@store')->name('privacy.insert');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
