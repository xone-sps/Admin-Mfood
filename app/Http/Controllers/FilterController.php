<?php

namespace App\Http\Controllers;

use App\models\unit;
use Illuminate\Http\Request;
use App\models\product_type;
use App\models\product;
use DB;

class FilterController extends Controller
{
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

    public function ListProducts(Request $request)
    {
        $user = $request->user('api');
        if (isset($user, $user->restaurant)) {
            $products = product::select('products.id', 'products.product_name',
                'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
                'product_type.type', 'product_type.id as proTypeId', 'products.file')
                ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
                ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
                ->where('products.restaurant_id', $user->restaurant->id)
                ->orderBy('products.id', 'desc')
                ->get();
            $units = unit::orderBy('id', 'desc')->get();

            return response()->json([
                'products' => $products,
                'units' => $units
            ]);
        }
        return response()->json([
            'products' => [],
            'units' => []
        ]);
    }


    public function FilterListMenu(Request $request, $typeId)
    {
        $user = $request->user('api');
        if (isset($user, $user->restaurant)) {
            $filters = product::select('products.id', 'products.product_name',
                'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
                'product_type.type', 'product_type.id as proTypeId', 'products.file')
                ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
                ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
                ->where('products.restaurant_id', $user->restaurant->id)
                ->where('products.product_type_id', $typeId)
                ->orderBy('products.id', 'desc')
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
