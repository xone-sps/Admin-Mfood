<?php

namespace App\Http\Request\Customer;

use App\models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', Rule::in($this->customers())],
            'name' => ['required', 'max:191'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->id, 'max:191'],
            'password' => ['required', 'min:8', 'max:191'],
            'customer_name' => ['required', 'max:191'],
            'customer_surname' => ['required', 'max:191'],
        ];
    }

    public function customers()
    {
        return Customer::where('restaurant_id', $this->user('api')->restaurant->id)->get()->pluck('id');
    }
}
