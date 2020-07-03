<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public static function AddProducts($item, $restaurantId){
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
        $add->restaurant_id = $restaurantId;
        $add->save();
        if($add){
            return true;
        }else{
            return false;
        }
    }
    public static function EditProducts($item, $id){
        $edit_product = self::find($id);

        if(isset($item->file)){
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
            if(isset($edit_product->file)){
                unlink(public_path().'/images/restaurants/file_menu/' . $edit_product->file);
            }
            $edit_product->file = $item->file;
        }

        
        $edit_product->product_name = $item->product_name;
        $edit_product->amount = $item->amount;
        $edit_product->price = $item->price;
        $edit_product->product_type_id = $item->proTypeId;
        $edit_product->unit_id = $item->unitId;
        $edit_product->save();
        if($edit_product){
            return true;
        }else{
            return false;
        }

    }
    
}
