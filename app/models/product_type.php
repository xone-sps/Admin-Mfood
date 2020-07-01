<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class product_type extends Model
{
    use SoftDeletes;


    # Add
    public static function AddProductType($item){
        $add = new self;
        $add->type = $item->type;
        $add->restaurant_id = 1;
        $add->save();
        if($add){
            return true;
        }else{
            return false;
        }
    }

    # Edit
    public static function EditProductType($item, $id){
        $edit = self::find($id);
        $edit->type = $item->type;
        $edit->save();
        if($edit){
            return true;
        }else{
            return false;
        }
    }
    
    # Delete
    public static function DeleteProductType($id){
        $delete = self::find($id);
        $delete->delete();
        if($delete){
            return true;
        }else{
            return false;
        }
    }
}
