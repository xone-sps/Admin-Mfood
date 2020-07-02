<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public static function AddProducts($item){
        $fileName = substr($item->file, 0, strrpos($item->file, "."));
        $oldPath = 'images/uploadFile/'. $item->file; 

        $fileExtension = \File::extension($oldPath);
        $newName = $fileName.'.'.$fileExtension;
        $newPathWithName = 'images/restaurants/file_menu/'.$newName;

        if(\File::copy($oldPath , $newPathWithName)){
            if(isset($item->file)){
                unlink(public_path().'/images/uploadFile/' . $item->file);
            }
        }

        $add = new product;
        $add->product_name = $item->product_name;
        $add->amount = $item->amount;
        $add->price = $item->price;
        $add->product_type_id = $item->type;
        $add->unit_id = $item->unit;
        $add->file = $item->file;
        $add->restaurant_id = 1;
        $add->save();
        if($add){
            return true;
        }else{
            return false;
        }
    }
    
}
