<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use App\User;


class restaurant extends Model
{
    use SoftDeletes;
    
    # Add-Restaurants
    public static function AddRestaurants($item){
        $fileName = substr($item->logo, 0, strrpos($item->logo, "."));
        $oldPath = 'images/uploadFile/'. $item->logo; 

        $fileExtension = \File::extension($oldPath);
        $newName = $fileName.'.'.$fileExtension;
        $newPathWithName = 'images/restaurants/'.$newName;

        if(\File::copy($oldPath , $newPathWithName)){
            if(isset($item->logo)){
                unlink(public_path().'/images/uploadFile/' . $item->logo);
            }
        }

        $add_user = new User;
        $add_user->name = $item->name;
        $add_user->email = $item->email;
        $add_user->password = Hash::make($item->password);
        $add_user->user_type = 'Restaurant';
        $add_user->status_user = 'Approved';
        $add_user->save();

        $add_restaurant = new self;
        $add_restaurant->name = $item->name;
        $add_restaurant->mobile = $item->mobile;
        $add_restaurant->address = $item->address;
        $add_restaurant->logo = $item->logo;
        $add_restaurant->user_id = $add_user->id;
        $add_restaurant->save();

        return true;
    }

    # Edit-Restaurant
    public static function EditRestaurant($item, $id, $userId){
        $restaurant = self::where('id', $id)->first();

        if(isset($item->logo)){
            $fileName = substr($item->logo, 0, strrpos($item->logo, "."));
            $oldPath = 'images/uploadFile/'. $item->logo; 

            $fileExtension = \File::extension($oldPath);
            $newName = $fileName.'.'.$fileExtension;
            $newPathWithName = 'images/restaurants/'.$newName;

            if(\File::copy($oldPath , $newPathWithName)){
                if(isset($item->logo)){
                    unlink(public_path().'/images/uploadFile/' . $item->logo);
                }
            }

            if(isset($restaurant->logo)){
                unlink(public_path().'/images/restaurants/' . $restaurant->logo);
            }
        }

        $edit_user = User::find($userId);
        $edit_user->name = $item->name;
        $edit_user->email = $item->email;
        $edit_user->save();

        $edit_restaurant = self::find($id);
        $edit_restaurant->name = $item->name;
        $edit_restaurant->mobile = $item->mobile;
        $edit_restaurant->address = $item->address;
        $edit_restaurant->logo = $item->logo;
        $edit_restaurant->save();

        return true;
    }

    # Delete-Restaurant
    public static function DeleteRestaurant($id){
        $delete_restaurant = self::find($id);
        $delete_restaurant->delete();

        $delete_user = User::find($delete_restaurant->user_id);
        $delete_user->delete();

        return true;
    }
}
