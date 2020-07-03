<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\order;
use App\models\cashier;
use App\models\order_detail;


class OrderProductController extends Controller
{

    // public $cashier;

    // public function __construct()
    // {
    //     $this->cashier = cashier::where('user_id', Auth::guard('api')->user()->id)->first();
    // }



    # List-Order-Products
    public function ListOrderProducts(){
        $listPending = order::where('cashier_id', 1)
        ->where('status_payment', 'pending')
        ->get();
        $listPending->map(function($data){
            $data->orderDetails = order_detail::where('order_id', $data->id)->get();
        });

        $listSuccess = order::where('cashier_id', 1)
        ->where('status_payment', 'success')
        ->get();
        $listSuccess->map(function($data){
            $data->orderDetails = order_detail::where('order_id', $data->id)->get();
        });

        return response()->json([
            'listPending' => $listPending,
            'listSuccess' => $listSuccess
        ]);
    }

    # List-OrderDetails
    public function ListOrderDetails(){
        $listOrderDetail_Ordered = order_detail::where('status_cooking', 'ordered')->get();
        $listOrderDetail_CookedDone = order_detail::where('status_cooking', 'cooked_done')->get();

        return response()->json([
            'listOrdered' => $listOrderDetail_Ordered,
            'listCookedDone' => $listOrderDetail_CookedDone
        ]);
    }

    # Order-Products
    public function OrderProducts(Request $request){
        $order = order::OrderProducts($request);
        if($order == true){
            return response()->json([
                'success' => true,
                'msg' => 'ສັ່ງຊື້ສຳເລັດເເລ້ວ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }

    # Payment-Order
    public function PaymentOrder($orderId){
        $checkOrderId = order::where('id', $orderId)->where('status_payment', 'success')->first();
        
        if(!isset($checkOrderId)){
            $payment = order::PaymentOrder($orderId);
            if($payment == true){
                return response()->json([
                    'success' => true,
                    'msg' => 'ຊຳລະສຳເລັດເເລ້ວ...'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເລກບີນນີ້ໄດ້ຊຳລະເງີນເເລ້ວ...'
            ]);
        }
    }

    # Update Status-OrderDetails
    public function UpdateStatusorderDetails($detailId){
        $updateOrderDetail = order_detail::UpdateStatusorderDetails($detailId);
        if($updateOrderDetail == true){
            return response()->json([
                'success' => true,
                'msg' => 'ຄົວສຳເລັດເເລ້ວ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }

}
