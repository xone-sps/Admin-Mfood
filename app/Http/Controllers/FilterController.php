<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\product_type;
use App\models\product;


class FilterController extends Controller
{
    
    public function FilterListMenu($typeId){
        $filters = product::select('products.id', 'products.product_name', 
        'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
        'product_type.type', 'product_type.id as proTypeId', 'products.file')
        ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
        ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
        ->where('products.restaurant_id', 1)
        ->where('products.product_type_id', $typeId)
        ->orderBy('products.id', 'desc')
        ->get();
        return response()->json([
            'filters' => $filters
        ]);
    }
}
