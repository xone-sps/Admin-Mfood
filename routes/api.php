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


Route::post('sign-in', 'ApiLoginController@SignIn');
Route::post('sign-out', 'ApiLoginController@SignOut');

Route::post('upload-file', 'FilterController@UploadFile');


Route::group(['middleware' => 'auth:api'], function(){

    # Restaurants
    Route::get('list-restaurants', 'ApiAdminController@ListRestaurants');
    Route::post('add-restaurants', 'ApiAdminController@AddRestaurants');
    Route::post('edit-restaurants/{id}', 'ApiAdminController@EditRestaurants');
    Route::get('delete-restaurants/{id}', 'ApiAdminController@DeleteRestaurants');

    # Waiters
    Route::get('list-waiters', 'ApiAdminController@ListWaiter');
    Route::post('add-waiters', 'ApiAdminController@AddWaiter');
    Route::post('edit-waiters/{id}', 'ApiAdminController@EditWaiter');
    Route::get('delete-waiters/{id}', 'ApiAdminController@DeleteWaiter');
    
    # Cashiers
    Route::get('list-cashiers', 'ApiAdminController@ListCashiers');
    Route::post('add-cashiers', 'ApiAdminController@AddCashiers');
    Route::post('edit-cashiers/{id}', 'ApiAdminController@EditCashiers');
    Route::get('delete-cashiers/{id}', 'ApiAdminController@DeleteCashiers');

    # Kitchens
    Route::get('list-kitchens', 'ApiAdminController@Listkitchens');
    Route::post('add-kitchens', 'ApiAdminController@Addkitchens');
    Route::post('edit-kitchens/{id}', 'ApiAdminController@Editkitchens');
    Route::get('delete-kitchens/{id}', 'ApiAdminController@Deletekitchens');

    # Product-Types
    Route::get('list-product-types', 'ApiAdminController@ListProductType');
    Route::post('add-product-types', 'ApiAdminController@AddProductType');
    Route::post('edit-product-types/{id}', 'ApiAdminController@EditProductType');
    Route::get('delete-product-types/{id}', 'ApiAdminController@DeleteProductType');

    # Products
    Route::get('list-products', 'ApiAdminController@ListProducts');
    Route::post('add-products', 'ApiAdminController@AddProducts');
    Route::post('edit-products/{id}', 'ApiAdminController@EditProducts');
    Route::get('delete-products/{id}', 'ApiAdminController@DeleteProducts');
    
    # Filter List-Menu
    Route::get('filter-list-menu/{type_id}', 'FilterController@FilterListMenu');


    /* .............................................................................. */

    # Order-Products
    Route::post('order-products', 'OrderProductController@OrderProducts');

    # List-Order AND List-OrderDetail
    Route::get('list-order-products', 'OrderProductController@ListOrderProducts');
    Route::get('list-order-detail', 'OrderProductController@ListOrderDetails');
    
    # Payment-Order
    Route::get('payment-order/{order_id}', 'OrderProductController@PaymentOrder');
    # Update Status-Order After Cooking On Success
    Route::get('update-status-order-detail/{orderdetail_id}', 'OrderProductController@UpdateStatusorderDetails');

});

Route::get('list-data', 'FilterController@ListData');



