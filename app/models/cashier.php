<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\models\restaurant;


class cashier extends Model
{
    use SoftDeletes;

    
    # Add Cashier
    public static function AddCashiers($item, $restaurantId){
        $add_user = new User;
        $add_user->name = $item->name;
        $add_user->email = $item->email;
        $add_user->password = Hash::make($item->password);
        $add_user->user_type = 'Cashier';
        $add_user->status_user = 'Approved';
        $add_user->save();

        $add_cashier = new self;
        $add_cashier->card_id = $item->card_id;
        $add_cashier->name = $item->name;
        $add_cashier->sure = $item->sure;
        $add_cashier->user_id = $add_user->id;
        $add_cashier->restaurant_id = $restaurantId;
        $add_cashier->save();

        return true;
    }
    # Edit-Cashier
    public static function EditWaiter($item, $cashier){
        $edit_user = User::find($cashier->user_id);
        $edit_user->name = $item->name;
        $edit_user->email = $item->email;
        $edit_user->save();

        $edit_cashier = self::find($cashier->id);
        $edit_cashier->card_id = $item->card_id;
        $edit_cashier->name = $item->name;
        $edit_cashier->sure = $item->sure;
        $edit_cashier->save();

        return true;
    }
    # delete-Cashier
    public static function DeleteCashier($id){
        $delete_cashier = self::find($id);
        $delete_cashier->delete();

        $delete_user = User::find($delete_cashier->user_id);
        $delete_user->delete();

        return true;
    }
}
