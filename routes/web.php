<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/admin','backend\AdminController@loginForm')->name('admin');
Route::get('/signup','backend\AdminController@signupForm')->name('signup');
Route::post('/logadmin', 'backend\AdminController@login');
Route::post('/signup', 'backend\AdminController@signup');


Route::group(['middleware' => 'admin'], function () {
	Route::get('/', 'backend\AdminController@dashboard')->name('dashboard');
	Route::get('/home', 'backend\AdminController@dashboard')->name('dashboard');
	Route::get('/dashboard','backend\AdminController@dashboard')->name('dashboard');
    Route::resource('/users','backend\UserController');
	Route::resource('/account','backend\AccountController');
	Route::get('/accountsearch', 'backend\AccountController@search')->name('accountsearch');
    Route::get('/account/status/{id}','backend\AccountController@status');
    Route::get('/account/contact/{id}','backend\AccountController@contact');
	Route::resource('/phone','backend\PhoneController');
	Route::get('/phonesearch', 'backend\PhoneController@search')->name('phonesearch');
	Route::resource('/email','backend\EmailController');
	Route::get('/emailsearch', 'backend\EmailController@search')->name('emailsearch');
	Route::get('/adminsearch', 'backend\AdminController@search')->name('adminsearch');
	Route::get('/users/profile/{id}',['as'=> 'profile','uses'=>'backend\UserController@profile']);

});
Route::get('{slug}', 'frontend\StandardController@index')->where('slug', '[A-Za-z0-9_\-]+');
