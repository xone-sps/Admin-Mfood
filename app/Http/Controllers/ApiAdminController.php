<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\models\restaurant;
use App\models\cashier;
use App\models\waiter;
use App\models\kitchen;
use Validator;
use Illuminate\Support\Facades\Auth;

class ApiAdminController extends Controller
{
    
    # Upload-File
    public function UploadFile(Request $request){
        return $request->all();
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

    # Waiters
    public function ListWaiter(){
        $waiters = waiter::orderBy('id', 'desc')->get();
        return response()->json([
            'waiters' => $waiters
        ]);
    }
    public function AddWaiter(Request $request){
        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users'
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານກ່ອນ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $add_waiters = waiter::AddWaiter($request);

        if($add_waiters == true){
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
    public function EditWaiter(Request $request, $id){
        $waiter = waiter::where('id', $id)->first();

        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'email' => 'required|unique:users,email,'.$waiter->user_id
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);
        
        $edit_waiters = waiter::EditWaiter($request, $waiter);

        if($edit_waiters == true){
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
    public function DeleteWaiter($id){
        $delete_waiter = waiter::DeleteWaiter($id);
        
        if($delete_waiter == true){
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

    # Cashiers
    public function ListCashiers(){
        $cashiers = cashier::orderBy('id', 'desc')->get();
        return response()->json([
            'cashiers' => $cashiers
        ]);
    }
    public function AddCashiers(Request $request){
        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users'
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານກ່ອນ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $add_cashier = cashier::AddCashiers($request);

        if($add_cashier == true){
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
    public function EditCashiers(Request $request, $id){
        $cashier = cashier::where('id', $id)->first();

        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'email' => 'required|unique:users,email,'.$cashier->user_id
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);
        
        $edit_cashier = cashier::EditWaiter($request, $cashier);

        if($edit_cashier == true){
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
    public function DeleteCashiers($id){
        $delete_cashier = cashier::DeleteCashier($id);
        
        if($delete_cashier == true){
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

    # CRUD-Kitchens
    public function Listkitchens(){
        $kitchens = kitchen::orderBy('id', 'desc')->get();
        return response()->json([
            'kitchens' => $kitchens
        ]);
    }
    public function Addkitchens(Request $request){
        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users'
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
            'password.required' => 'ກະລຸນາປ້ອນລະຫັດຜ່ານກ່ອນ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $add_kitchen = kitchen::Addkitchen($request);

        if($add_kitchen == true){
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
    public function Editkitchens(Request $request, $id){
        $kitchen = kitchen::where('id', $id)->first();

        $rules = [
            'name' => 'required', 
            'sure' => 'required', 
            'card_id' => 'required',
            'email' => 'required|unique:users,email,'.$kitchen->user_id
        ];
        $msg = [
            'name.required' => 'ກະລຸນາປ້ອນຊື່ກ່ອນ...',
            'sure.required' => 'ກະລຸນາປ້ອນນາມສະກຸນກ່ອນ...',
            'card_id.required' => 'ກະລຸນາປ້ອນເລກໄອດີກ່ອນ...',
            'email.required' => 'ກະລຸນາປ້ອນອີເມວກ່ອນ...',
            'email.unique' => 'ອີເມວນີ້ມີໃນລະບົບເເລ້ວ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);
        
        $edit_kitchen = kitchen::Editkitchen($request, $kitchen);

        if($edit_kitchen == true){
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
    public function Deletekitchens($id){
        $delete_kitchen = kitchen::Deletekitchen($id);
        
        if($delete_kitchen == true){
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
