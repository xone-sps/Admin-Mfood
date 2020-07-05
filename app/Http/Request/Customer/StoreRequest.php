<?php

namespace App\Http\Request\Customer;

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
        return $user->user_type === 'Restaurant';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:191'],
            'email' => ['required', 'email', 'unique:users,email', 'max:191'],
            'password' => ['required', 'min:8', 'max:191'],
            'customer_name' => ['required', 'max:191'],
            'customer_surname' => ['required', 'max:191'],
        ];
    }
}
