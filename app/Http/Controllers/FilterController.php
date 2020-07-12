<?php

namespace App\Http\Controllers;

use App\models\order;
use App\models\unit;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use App\models\product_type;
use App\models\product;
use DB;

class FilterController extends Controller
{
    const ImagePath = '/images/restaurants/file_menu';

    # Upload-File
    public function UploadFile(Request $request)
    {
        if ($request->hasfile('imageFile')) {
            $file = $request->file('imageFile');
            $names = md5(date('Y-m-d h:m:s') . microtime()) . time() . '_file.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/images/uploadFile/', $names);
        }

        return response()->json([
            'success' => true,
            'fileName' => $names
        ]);
    }

    public function ListMenuTypes(Request $request)
    {
        $user = $request->user('api');
        if (isset($user, $user->customer)) {
            $categories = product_type::select('product_types.id', 'product_types.type')
                ->join('restaurants as restaurant', 'restaurant.id', '=', 'product_types.restaurant_id')
                ->where('product_types.restaurant_id', $user->customer->restaurant_id)
                ->orderBy('product_types.id', 'desc')
                ->get();
            return response()->json([
                'product_type' => $categories,
            ]);
        }
        return response()->json([
            'product_type' => [],
        ]);
    }


    public function FilterListMenu(Request $request, $typeId)
    {
        $url = url(self::ImagePath);
        $user = $request->user('api');
        if (isset($user, $user->customer)) {
            $restaurantId = $user->customer->restaurant_id;
            $orders = order::selectRaw('order_details.product_id, sum(order_details.amount) as availableAmount')
                ->join('order_details', 'order_details.order_id', 'orders.id')
                ->where('orders.restaurant_id', $restaurantId)
                ->where('orders.status_payment', 'pending')
                ->groupBy(['order_details.product_id']);
            $filters = product::select('products.id', 'products.product_name',
                'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
                'product_type.type', 'product_type.id as proTypeId', 'products.file',
                'order_items.availableAmount')
                ->selectRaw("CONCAT('{$url}/', products.file) as file_url")
                ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
                ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
                ->leftJoinSub($orders, 'order_items', function (JoinClause $leftJoin) {
                    return $leftJoin->on('products.id', '=', 'order_items.product_id');
                })->where('products.restaurant_id', $restaurantId)
                ->where('products.product_type_id', $typeId)
                ->orderBy('products.id', 'desc')
                ->having('order_items.availableAmount', '>', 0)
                ->get();
            return response()->json([
                'filters' => $filters
            ]);
        }
        return response()->json([
            'filters' => []
        ]);
    }
}
