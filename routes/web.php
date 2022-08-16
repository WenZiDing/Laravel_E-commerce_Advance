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

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', 'WebController@index');
Route::get('/contact-us', 'WebController@contactUs');
Route::post('/read-notification', 'WebController@readNotification');
Route::get('/products/{id}/share-url', 'ProductController@sharedUrl');
Route::post('/products/check-product', 'ProductController@CheckProduct');

Route::resource('/admin/orders', 'Admin\OrderController');
Route::post('/admin/orders/{id}/delivery', 'Admin\OrderController@delivery');
Route::post('/admin/Tools/update-product-price', 'Admin\ToolController@updateProductPrice');
Route::post('/admin/Tools/create-product-redis', 'Admin\ToolController@createProductRedis');

Route::group(['middleware' => 'check.dirty'], function(){
	Route::resource('products','ProductController');
});
//Route::resource('products','ProductController');

Route::post('signup','AuthController@signup');
Route::post('login','AuthController@login');
Route::group(['middleware'=>'auth:api'], function(){
  Route::resource('carts','CartController');
  Route::resource('cart-items','CartItemsController');
  Route::get('user','AuthController@user');
  Route::get('logout','AuthController@logout');
  Route::post('carts/checkout','CartController@checkout');
});
