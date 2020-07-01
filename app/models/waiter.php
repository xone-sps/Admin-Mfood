<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\models\restaurant;


class waiter extends Model
{
    use SoftDeletes;

    # Add-Waiter
    public static function AddWaiter($item){
        //$checkDate = restaurant::where('user_id', Auth::guard('api')->user()->id)->first();
    
        $add_user = new User;
        $add_user->name = $item->name;
        $add_user->email = $item->email;
        $add_user->password = Hash::make($item->password);
        $add_user->user_type = 'Waiter';
        $add_user->status_user = 'Approved';
        $add_user->save();

        $add_waiter = new self;
        $add_waiter->card_id = $item->card_id;
        $add_waiter->name = $item->name;
        $add_waiter->sure = $item->sure;
        $add_waiter->user_id = $add_user->id;
        //$add_waiter->restaurant_id = $checkDate->id;
        $add_waiter->restaurant_id = 1;
        $add_waiter->save();

        return true;
    }
    public static function EditWaiter($item, $waiter){
        $edit_user = User::find($waiter->user_id);
        $edit_user->name = $item->name;
        $edit_user->email = $item->email;
        $edit_user->save();

        $edit_waiter = self::find($waiter->id);
        $edit_waiter->card_id = $item->card_id;
        $edit_waiter->name = $item->name;
        $edit_waiter->sure = $item->sure;
        $edit_waiter->save();

        return true;
    }
    public static function DeleteWaiter($id){
        $delete_waiter = self::find($id);
        $delete_waiter->delete();

        $delete_user = User::find($delete_waiter->user_id);
        $delete_user->delete();

        return true;
    }

}
