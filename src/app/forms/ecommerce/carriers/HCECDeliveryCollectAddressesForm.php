<?php

namespace interactivesolutions\honeycombecommercecarriers\app\forms\ecommerce\carriers;

use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers\HCECDeliveryOptions;

class HCECDeliveryCollectAddressesForm
{
    // name of the form
    protected $formID = 'e-commerce-carriers-collect-addresses';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.e.commerce.carriers.collect.addresses'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "delivery_option_id",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.delivery_option_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECDeliveryOptions::with('translations')->where('type', 'self collected')->get(),
                    "search"          => [
                        "showNodes"              => ['translations.{lang}.label'],
                        "maximumSelectionLength" => 1,
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "second_name",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.second_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "city",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.city"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "textArea",
                    "fieldID"         => "address",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.address"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "rows"            => 5,
                ],
                [
                    "type"            => "textArea",
                    "fieldID"         => "comment",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_collect_addresses.comment"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "rows"            => 5,
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}
