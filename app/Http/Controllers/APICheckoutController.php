<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Request\Checkout\OrderProductRequest;
use App\models\order;
use Illuminate\Http\Request;

class APICheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param OrderProductRequest $request
     */
    public function checkingOrderProductsQuantity(OrderProductRequest $request)
    {
        $user = $request->user('api');
        $orders = AppHelper::parseJSON($request->orders);
        return order::checkingOrderProductQuantity($orders, $user->customer->restaurant_id);
    }
}
