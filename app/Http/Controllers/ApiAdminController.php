<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiAdminController extends Controller
{
    //
    public function ListRestaurants(){
        $user = User::all();
        return response()->json([
            'data' => $user
        ]);
    }
}
