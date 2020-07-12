<?php

namespace App\models;

use App\Helpers\AppHelper;
use App\Http\Controllers\FilterController;
use Illuminate\Database\Eloquent\Model;


class order extends Model
{
    # Order-Products
    public static function OrderProducts(Customer $customer, $data)
    {
        $orders = AppHelper::parseJSON($data);
        $validOrders = self::checkingOrderProductQuantity($orders);
        if (count($validOrders) > 0) {
            $add_order = new self;
            $add_order->total = 0;
            $add_order->customer_id = $customer->id;
            $add_order->restaurant_id = $customer->restaurant->id;
            $add_order->save();
            # Update-OrderId
            $update_orderId = self::find($add_order->id);
            $update_orderId->order_id = 'OR-000' . $add_order->id;
            $update_orderId->save();

            $totalPrice = 0;
            foreach ($validOrders as $order) {
                $add_orderDetail = new order_detail;
                $add_orderDetail->order_id = $add_order->id;
                $productDetail = self::createProductOrder($order['productId'], $order['amount']);
                $add_orderDetail->product_id = $productDetail['productId'];
                $add_orderDetail->price = $productDetail['price'];
                $add_orderDetail->amount = $productDetail['amount'];
                $add_orderDetail->total = $productDetail['total'];
                $totalPrice = $totalPrice + $productDetail['total'];
                $add_orderDetail->save();
            }

            // update total price
            $update_orderId->total = $totalPrice;
            $update_orderId->save();

            $add_queueNumber = new queue_number;
            $add_queueNumber->order_id = $add_order->id;
            $add_queueNumber->save();

            $update_queueNumber = queue_number::find($add_queueNumber->id);
            $update_queueNumber->queue_number = 'Q-' . $add_queueNumber->id;
            $update_queueNumber->save();
            return ['success' => $update_orderId];
        }
        return [
            'success' => false,
        ];
    }

    # Payment-Order
    public static function PaymentOrder($orderId)
    {
        $payment = self::find($orderId);
        $payment->status_payment = 'success';
        $payment->save();
        self::stockReduction($orderId);

        if ($payment) {
            return true;
        }
        return false;
    }

    public static function createProductOrder($productId, $amount)
    {
        $product = product::find($productId);
        $price = $product->price;
        $totalPrice = $price * $amount;
        return [
            'productId' => $productId,
            'price' => $price,
            'total' => $totalPrice,
            'amount' => $amount,
        ];
    }

    public static function stockReduction($orderId)
    {
        $order = order::where('id', $orderId)->whereIn('status_payment', ['reject', 'success'])->first();
        if (isset($order)) {
            $orderDetails = order_detail::where('order_id', $order->id);
            foreach ($orderDetails as $orderDetail) {
                $product = product::find($orderDetail->product_id);
                if (isset($product)) {
                    $product->amount = ($product->amount - $orderDetail->amount);
                    $product->save();
                }
            }
        }
    }

    public static function checkingOrderProductQuantity($orders)
    {
        $orderCollection = collect([]);
        foreach ($orders as $jsonObj) {
            $productId = $jsonObj->productId;
            $amount = $jsonObj->amount;
            $product = product::find($productId);
            $totalProductPendingOrderAmount = order::join('order_details', 'order_details.order_id', 'orders.id')
                ->where('order_details.product_id', $productId)
                ->where('orders.status_payment', 'pending')
                ->sum('order_details.amount');
            if (isset($product)) {
                $calculateAmount = $product->amount - $totalProductPendingOrderAmount; // 4 - 2 = 2
                $calculateAmount = $calculateAmount - $amount; // 2 - 4 = -2 || 2 - 2 = 0 || 2 - 1 = 1
                if ($calculateAmount >= 0) {
                    $finalAmount = $amount;
                } else {
                    $finalAmount = ($product->amount - $totalProductPendingOrderAmount);
                }
                $product->file_url = url(FilterController::ImagePath) . '/' . $product->file;
                $orderCollection->push([
                    'productId' => $productId,
                    'amount' => $finalAmount,
                    'product' => $product,
                    'totalAmount' => $totalProductPendingOrderAmount,
                ]);
            }
        }
        return $orderCollection;
    }
}
