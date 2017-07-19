<?php namespace interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce\carriers;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECDeliveryOptionsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'carrier'     => 'required',
            'type'        => 'required',
            'fixed_price' => 'required',

        ];
    }
}