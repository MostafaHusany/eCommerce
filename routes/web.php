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


Auth::routes();

// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Admin\DashboardController@index')->middleware('auth');
Route::get('/admin', 'Admin\DashboardController@index')->name('admin.dashboard')->middleware('auth');
Route::get('/admin/users', 'Admin\UsersController@index')->name('admin.users');//->middleware('auth');
Route::get('/admin/categories', 'Admin\CategoriesController@index')->name('admin.categories')->middleware('auth');
Route::get('/admin/products', 'Admin\ProductsController@index')->name('admin.products')->middleware('auth');
Route::get('/admin/orders', 'Admin\OrderController@index')->name('admin.orders')->middleware('auth');
