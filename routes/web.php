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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
