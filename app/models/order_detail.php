<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    # Update-OrderDetails
    public static function UpdateStatusorderDetails($detailId){
        $update = self::find($detailId);
        $update->status_cooking = 'cooked_done';
        $update->save();
        if($update){
            return true;
        }else{
            return false;
        }
    }
}
