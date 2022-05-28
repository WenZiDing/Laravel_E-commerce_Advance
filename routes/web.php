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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'check.dirty'], function(){
	Route::resource('products','ProductController');
});
//Route::resource('products','ProductController');
Route::resource('carts','CartController');
Route::resource('cart-items','CartItemsController');
Route::post('signup','AuthController@signup');
Route::post('login','AuthController@login');
