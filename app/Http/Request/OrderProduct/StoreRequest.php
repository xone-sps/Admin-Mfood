<?php

namespace App\Http\Request\OrderProduct;

use App\Rules\OrderProduct;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user('api');
        return $user->user_type === 'Customer';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customer = $this->user('api')->customer;
        return [
            'orders' => ['required', 'string', new OrderProduct($customer)],
        ];
    }
}
