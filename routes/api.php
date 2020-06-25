<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('admin/sign-in', 'ApiLoginController@AdminSignIn');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

# Upload-File
Route::post('upload-file', 'ApiAdminController@UploadFile');


Route::get('list-restaurants', 'ApiAdminController@ListRestaurants');
Route::post('add-restaurants', 'ApiAdminController@AddRestaurants');
Route::post('edit-restaurants/{id}', 'ApiAdminController@EditRestaurants');
Route::get('delete-restaurants/{id}', 'ApiAdminController@DeleteRestaurants');

// Route::get('edit-restaurants', 'ApiAdminController@ListRestaurants');
// Route::get('list-restaurants', 'ApiAdminController@ListRestaurants');
