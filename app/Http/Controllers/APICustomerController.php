<?php

namespace App\Http\Controllers;

use App\Http\Request\Customer\DeleteRequest;
use App\Http\Request\Customer\ListRequest;
use App\Http\Request\Customer\StoreRequest;
use App\Http\Request\Customer\UpdateRequest;
use App\models\Customer;
use App\models\order;
use App\User;
use Illuminate\Support\Facades\Hash;

class APICustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ListRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        return Customer::where('restaurant_id', $request->user('api')->restaurant->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     */
    public function store(StoreRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'Customer';
        $user->status_user = 'Approved';
        $user->save();
        $customer = new Customer();
        $customer->name = $request->customer_name;
        $customer->surname = $request->customer_surname;
        $customer->user_id = $user->id;
        $customer->restaurant_id = $request->user('api')->restaurant->id;
        $customer->save();

        return $this->edit($customer->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        return Customer::with(['user', 'restaurant'])->where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     */
    public function update(UpdateRequest $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->customer_name;
        $customer->surname = $request->customer_surname;
        $customer->save();
        $user = $customer->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return $this->edit($customer->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param int $id
     */
    public function delete(DeleteRequest $request, $id)
    {
        $customer = Customer::where('id', $id)->first();
        $hasOrder = order::where('customer_id', $id)->exists();
        if ($hasOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete the customer caused by it is already used.'
            ]);
        }
        $customer->delete();
        return $customer;
    }
}
