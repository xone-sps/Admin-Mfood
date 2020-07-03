<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\models\restaurant;


class kitchen extends Model
{
    use SoftDeletes;


    # Add-Kitchens
    public static function Addkitchen($item, $restaurantId){
        $add_user = new User;
        $add_user->name = $item->name;
        $add_user->email = $item->email;
        $add_user->password = Hash::make($item->password);
        $add_user->user_type = 'Kitchen';
        $add_user->status_user = 'Approved';
        $add_user->save();

        $add_kitchen = new self;
        $add_kitchen->card_id = $item->card_id;
        $add_kitchen->name = $item->name;
        $add_kitchen->sure = $item->sure;
        $add_kitchen->user_id = $add_user->id;
        $add_kitchen->restaurant_id = $restaurantId;
        $add_kitchen->save();

        return true;
    }
    public static function Editkitchen($item, $kitchen){
        $edit_user = User::find($kitchen->user_id);
        $edit_user->name = $item->name;
        $edit_user->email = $item->email;
        $edit_user->save();

        $edit_kitchen = self::find($kitchen->id);
        $edit_kitchen->card_id = $item->card_id;
        $edit_kitchen->name = $item->name;
        $edit_kitchen->sure = $item->sure;
        $edit_kitchen->save();

        return true;
    }
    public static function Deletekitchen($id){
        $delete_kitchen = self::find($id);
        $delete_kitchen->delete();

        $delete_user = User::find($delete_kitchen->user_id);
        $delete_user->delete();

        return true;
    }
}
