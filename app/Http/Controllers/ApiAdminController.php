<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\models\restaurant;
use App\models\cashier;
use App\models\waiter;
use App\models\kitchen;
use Validator;

class ApiAdminController extends Controller
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

    public function ListRestaurants(){
        $restaurant = restaurant::all();

        return response()->json([
            'restaurant' => $restaurant
        ]);
    }
    public function AddRestaurants(Request $request){
        $addRestaurant = restaurant::AddRestaurants($request);
        if($addRestaurant == true){
            return response()->json([
                'success' => true,
                'msg' => 'ບັນທຶກສຳເລັດເເລ້ວ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }
    public function EditRestaurants(Request $request, $id){
        $user = restaurant::where('id', $id)->first();

        $rules = [
            'name' => 'required', 
            'mobile' => 'required|numeric',
            'address' => 'required',
            'logo' => 'required',
            'email' => 'required|unique:users,email,'.$user->user_id
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'mobile.required' => 'ກະລຸນາປ້ອນເບີຕິດຕໍ່ກ່ອນ...',
            'mobile.numeric' => 'ເບີຕິດຕໍ່ຄວນເປັນໂຕເລກ...',
            'address.required' => 'ກະລຸນາປ້ອນທີ່ຢູ່ກ່ອນ...',
            'logo.required' => 'ກະລຸນາເລືອກໂລໂກກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $edit_restaurant = restaurant::EditRestaurant($request, $id, $user->user_id);
        if($edit_restaurant == true){
            return response()->json([
                'success' => true,
                'msg' => 'ເເກ້ໄຂຂໍ້ມູນສຳເລັດເເລ້ວ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }
    public function DeleteRestaurants($id){
        $delete_restaurant = restaurant::DeleteRestaurant($id);
        return $delete_restaurant;
        if($delete_restaurant == true){
            return response()->json([
                'success' => true,
                'msg' => 'ລຶບຂໍ້ມູນສຳເລັດເເລ້ວ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }
}
