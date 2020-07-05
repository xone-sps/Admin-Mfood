<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\product_type;
use App\models\product;
use DB;

class FilterController extends Controller
{
    # Upload-File
    public function UploadFile(Request $request){
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
    


    public function FilterListMenu($typeId){
        $filters = product::select('products.id', 'products.product_name', 
        'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
        'product_type.type', 'product_type.id as proTypeId', 'products.file')
        ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
        ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
        ->where('products.restaurant_id', 2)
        ->where('products.product_type_id', $typeId)
        ->orderBy('products.id', 'desc')
        ->get();
        return response()->json([
            'filters' => $filters
        ]);
    }


    
    public function ListData(){
        $resume = DB::table('resume')->select('resume.id')->limit(20)->get();
        $resume->map(function($data){
            $data->contract = DB::table('resume_contact')->where('resume_id', $data->id)->select('phone')->first();
            $data->education_history = DB::table('resume_education_history')
            ->select('subject')
            ->limit(20)->get();
            $data->employment_history = DB::table('resume_employment_history')
            ->leftjoin('job_level as level', 'level.id', '=', 'resume_employment_history.level_id')
            ->where('resume_id', $data->id)
            ->select('position', 'level.name')
            ->limit(20)->get();
            $data->employment_history = DB::table('resume_employment_history')
            ->leftjoin('job_level as level', 'level.id', '=', 'resume_employment_history.level_id')
            ->where('resume_id', $data->id)
            ->select('position', 'level.name')
            ->limit(20)->get();
            

        });

        return response()->json([
            'resume' => $resume
        ]);
    }
}
