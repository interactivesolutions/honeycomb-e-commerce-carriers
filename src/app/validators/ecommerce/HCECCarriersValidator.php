<?php namespace interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECCarriersValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'label' => 'required',
        ];
    }
}