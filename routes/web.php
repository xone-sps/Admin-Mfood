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

Route::group(['prefix' => ''], function () {
    Route::get('/', 'RestaurantController@index')->name('restaurant.index');
    Route::get('/about', 'RestaurantController@index')->name('restaurant.about');
    Route::get('/tab-manage', 'RestaurantController@index')->name('restaurant.manage');
    Route::get('/tab-list-order', 'RestaurantController@index')->name('restaurant.list-order');
});
