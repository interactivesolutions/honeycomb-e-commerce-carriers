<?php namespace interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce\carriers;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECDeliveryCollectAddressesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'delivery_option_id' => 'required',
'address' => 'required',

        ];
    }
}