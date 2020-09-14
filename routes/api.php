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

Route::get('users', 'Admin\UsersController@get')->name('users.get');
Route::get('users/find', 'Admin\UsersController@find')->name('users.find');
Route::get('users/search', 'Admin\UsersController@search')->name('users.search');
Route::post('users/store', 'Admin\UsersController@store')->name('users.store');
Route::post('users/update', 'Admin\UsersController@update')->name('users.update');
Route::post('users/delete', 'Admin\UsersController@destroy')->name('users.delete');

Route::get('categories', 'Admin\CategoriesController@get')->name('categories.get');
Route::get('categories/show', 'Admin\CategoriesController@show')->name('categories.show');
Route::post('categories/store', 'Admin\CategoriesController@store')->name('categories.store');
Route::post('categories/destroy', 'Admin\CategoriesController@destroy')->name('categories.destroy');

Route::get('products', 'Admin\ProductsController@get')->name('products.get');
Route::get('products/show', 'Admin\ProductsController@show')->name('products.show');
Route::get('products/search', 'Admin\ProductsController@search')->name('products.search');
Route::post('products/store', 'Admin\ProductsController@store')->name('products.store');
Route::post('products/destroy', 'Admin\ProductsController@destroy')->name('products.destroy');


Route::get('orders', 'Admin\OrderController@get')->name('orders.get');
Route::post('orders/store', 'Admin\OrderController@store')->name('orders.store');
Route::post('orders/destroy', 'Admin\OrderController@destroy')->name('orders.destroy');

Route::get('main', 'Main\MainController@getLatest')->name('main.latest');
Route::get('main/products', 'Main\MainController@getProducts')->name('main.products');
