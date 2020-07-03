<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\models\restaurant;
use App\models\cashier;
use App\models\waiter;
use App\models\kitchen;
use App\models\product_type;
use App\models\product;
use App\models\unit;
use Validator;
use Illuminate\Support\Facades\Auth;

class ApiAdminController extends Controller
{
    
    // public $restaurant;

    // public function __construct()
    // {
    //     $this->restaurant = restaurant::where('user_id', Auth::guard('api')->user()->id)->first();
    // }


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
        $restaurant = restaurant::select('restaurants.*', 'user.email')
        ->leftjoin('users as user', 'user.id', '=', 'restaurants.user_id')
        ->orderBy('id', 'desc')
        ->get();

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
        $waiters = waiter::select('waiters.id', 'waiters.card_id', 
        'waiters.name', 'waiters.sure', 'user.email')
        ->join('users as user', 'user.id', '=', 'waiters.user_id')
        ->where('waiters.restaurant_id', $this->restaurant->id)
        ->orderBy('waiters.id', 'desc')
        ->get();

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

        $add_waiters = waiter::AddWaiter($request, $this->restaurant->id);
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
        $cashiers = cashier::select('cashiers.id', 'cashiers.card_id', 
        'cashiers.name', 'cashiers.sure', 'user.email')
        ->join('users as user', 'user.id', '=', 'cashiers.user_id')
        ->where('cashiers.restaurant_id', $this->restaurant->id)
        ->orderBy('cashiers.id', 'desc')
        ->get();
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

        $add_cashier = cashier::AddCashiers($request, $this->restaurant->id);

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
        $kitchens = kitchen::select('kitchens.id', 'kitchens.card_id', 
        'kitchens.name', 'kitchens.sure', 'user.email')
        ->join('users as user', 'user.id', '=', 'kitchens.user_id')
        ->where('kitchens.restaurant_id', $this->restaurant->id)
        ->orderBy('kitchens.id', 'desc')
        ->get();
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

        $add_kitchen = kitchen::Addkitchen($request, $this->restaurant->id);

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

    # Food-Types
    public function ListProductType(){
        $product_types = product_type::select('product_types.id', 'product_types.type')
        ->join('restaurants as restaurant', 'restaurant.id', '=', 'product_types.restaurant_id')
        ->where('product_types.restaurant_id', $this->restaurant->id)
        ->orderBy('product_types.id', 'desc')
        ->get();
        return response()->json([
            'product_type' => $product_types
        ]);
    }
    public function AddProductType(Request $request){
        $rules = [
            'type' => 'required', 
        ];
        $msg = [
            'type.required' => 'ກະລຸນາປ້ອນປະເພດກ່ອນ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $add_productType = product_type::AddProductType($request, $this->restaurant->id);

        if($add_productType == true){
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
    public function EditProductType(Request $request, $id){
        $rules = [
            'type' => 'required', 
        ];
        $msg = [
            'type.required' => 'ກະລຸນາປ້ອນປະເພດກ່ອນ...',
        ];
        $valueMsg = $this->validate($request, $rules, $msg);

        $edit_productType = product_type::EditProductType($request, $id);

        if($edit_productType == true){
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
    public function DeleteProductType($id){
        $delete_productType = product_type::DeleteProductType($id);
        
        if($delete_productType == true){
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

    # CRUD-Products
    public function ListProducts(){
        $products = product::select('products.id', 'products.product_name', 
        'products.amount', 'products.price', 'unit.unit', 'unit.id as unitId',
        'product_type.type', 'product_type.id as proTypeId', 'products.file')
        ->leftjoin('product_types as product_type', 'product_type.id', '=', 'products.product_type_id')
        ->leftjoin('units as unit', 'unit.id', '=', 'products.unit_id')
        ->where('products.restaurant_id', $this->restaurant->id)
        ->orderBy('products.id', 'desc')
        ->get();
        $units = unit::orderBy('id', 'desc')->get();

        return response()->json([
            'products' => $products,
            'units' => $units
        ]);
    }
    public function AddProducts(Request $request){
        $add_product = product::AddProducts($request, $this->restaurant->id);

        if($add_product == true){
            return response()->json([
                'success' => true,
                'msg' => 'ບັນທຶກຂໍ້ມູນສຳເລັດ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }
    public function EditProducts(Request $request, $id){
        $edit_product = product::EditProducts($request, $id);

        if($edit_product == true){
            return response()->json([
                'success' => true,
                'msg' => 'ເເກ້ໄຂຂໍ້ມູນສຳເລັດ...'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'ເກີດຂໍ້ຜິດພາດ...'
            ]);
        }
    }
}
