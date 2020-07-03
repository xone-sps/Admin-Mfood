<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\order_detail;
use App\models\queue_number;


class order extends Model
{
    
    # Order-Products
    public static function OrderProducts($item){
        if(isset($item)){
            $add_order = new self;
            $add_order->total = $item->totalPrice;
            $add_order->cashier_id = 1;
            $add_order->restaurant_id = 1;
            $add_order->save();
            # Update-OrderId
            $update_orderId = self::find($add_order->id);
            $update_orderId->order_id = 'OR-000'.$add_order->id;
            $update_orderId->save();

            foreach($item->orders as $order){
                $add_orderDetail = new order_detail;
                $add_orderDetail->order_id = $add_order->id;
                $add_orderDetail->product_id = $order['productId'];
                $add_orderDetail->price = $order['price'];
                $add_orderDetail->amount = $order['amount']; 
                $add_orderDetail->total = $order['total']; 
                $add_orderDetail->save();
            }

            $add_queueNumber = new queue_number;
            $add_queueNumber->order_id = $add_order->id;
            $add_queueNumber->save();

            $update_queueNumber = queue_number::find($add_queueNumber->id);
            $update_queueNumber->queue_number =  'Q-'.$add_queueNumber->id;
            $update_queueNumber->save();

            return true;
        }
    }

    # Payment-Order
    public static function PaymentOrder($orderId){
        $payment = self::find($orderId);
        $payment->status_payment = 'success';
        $payment->save();
        
        if($payment){
            return true;
        }else{
            return false;
        }
    }
}
