<?php

namespace App\Rules;

use App\Helpers\AppHelper;
use App\models\Customer;
use App\models\product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OrderProduct implements Rule
{
    /**
     * @var Customer
     */
    private $customer;

    /**
     * Create a new rule instance.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $orders = AppHelper::parseJSON($value);
        $isValid = false;
        if ($orders && is_array($orders)) {
            $isValid = collect($orders)->every(function ($jsonObj) {
                if (is_object($jsonObj)) {
                    $validator = Validator::make([
                        'productId' => $jsonObj->productId ?? null,
                        'amount' => $jsonObj->amount ?? null,
                    ], [
                        "productId" => ['required', \Illuminate\Validation\Rule::in($this->products())],
                        "amount" => ['required', 'gt:0', 'numeric'],
                    ]);
                    return !$validator->fails();
                }
                return false;
            });
        }
        return $isValid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ເມນູນີ້ມີຂໍ້ມູນບໍ່ຖືກຕ້ອງ!';
    }

    public function products()
    {
        return product::where('restaurant_id', $this->customer->restaurant->id)->get()->pluck('id');
    }
}
