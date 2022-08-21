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
//     return view('welcome');
// });
Route::get('/', 'WebController@index');
Route::get('/contact-us', 'WebController@contactUs');
Route::post('/read-notification', 'WebController@readNotification');
Route::get('/products/{id}/share-url', 'ProductController@sharedUrl');
Route::post('/products/check-product', 'ProductController@CheckProduct');

// admin
Route::group(['prefix' => '/admin'], function () {
    // admin - orders
    Route::group(['prefix' => '/Orders'], function () {
        Route::resource('', 'Admin\OrderController');
        Route::get('/excel/export', 'Admin\OrderController@export');
        Route::get('/excel/export-by-shipped', 'Admin\OrderController@ByShipped');
        Route::post('/{id}/delivery', 'Admin\OrderController@delivery');
    });
    // admin - Tools
    Route::group(['prefix' => '/Tools'], function () {
        Route::post('/update-product-price', 'Admin\ToolController@updateProductPrice');
        Route::post('/create-product-redis', 'Admin\ToolController@createProductRedis');
    });

    // admin - Product
    Route::group(['prefix' => '/Product'], function () {
        Route::resource('', 'Admin\ProductController');
        Route::post('/upload-image', 'Admin\ProductController@uploadImage');
        Route::post('/excel/import', 'Admin\ProductController@import');
    });

});


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
