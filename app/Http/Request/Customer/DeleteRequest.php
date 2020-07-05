<?php

namespace App\Http\Request\Customer;

use App\models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
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
            'id' => ['required', Rule::in($this->customers())]
        ];
    }

    public function customers()
    {
        return Customer::where('restaurant_id', $this->user('api')->restaurant->id)->get()->pluck('id');
    }
}
