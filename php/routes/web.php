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

Route::get('/', 'Controller@home')->name('home');
Route::get('/boxes', 'Controller@boxes')->name('boxes');
Route::get('/box/{id}/items', 'Controller@boxItemsExposed')->name('box_items');
//Route::get('/box/{id}/items', 'Controller@boxItems')->name('box_items')->where(['id' => '[0-9]+']);

Route::post('/search', 'Controller@searchExposed')->name('search');
//Route::post('/search', 'Controller@search')->name('search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{id}', 'HomeController@profileById')->name('profile');
//Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/payment_info/{id}', 'HomeController@paymentInfoById')->name('payment_info');
//Route::get('/payment_info', 'HomeController@paymentInfo')->name('payment_info');
Route::get('/admin/items', 'AdminController@items')->name('items');
Route::get('/admin/create_item', 'AdminController@item')->name('item');
Route::get('/admin/boxes', 'AdminController@boxes')->name('manage_boxes');
Route::get('/admin/create_box', 'AdminController@box')->name('create_boxes');

Route::post('/profile', 'HomeController@updateProfile')->name('update_profile');
Route::post('/payment_info', 'HomeController@updatePaymentInfo')->name('update_payment_info');
Route::post('/admin/item/create', 'AdminController@createItem')->name('create_item');
Route::post('/admin/item/update', 'AdminController@updateItem')->name('update_item');
Route::post('/admin/box/create', 'AdminController@createBox')->name('create_box');
Route::post('/admin/box/update', 'AdminController@updateBox')->name('update_box');
