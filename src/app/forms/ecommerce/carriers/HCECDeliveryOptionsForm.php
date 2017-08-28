<?php

namespace interactivesolutions\honeycombecommercecarriers\app\forms\ecommerce\carriers;

use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers\HCECDeliveryOptions;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;

class HCECDeliveryOptionsForm
{
    // name of the form
    protected $formID = 'e-commerce-carriers-delivery-options';

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
            'storageURL' => route('admin.api.routes.e.commerce.carriers.delivery.options'),
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
                    "fieldID"         => "carrier",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_delivery_options.carrier_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECCarriers::select('id', 'label')->has('delivery_options', '=', 0)->get(),
                    "search"          => [
                        "showNodes"              => ['label'],
                        "maximumSelectionLength" => 1,
                    ],
                ],
                [
                    "type"            => "radioList",
                    "fieldID"         => "type",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_delivery_options.type"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    'options'         => HCECDeliveryOptions::getTableEnumList('type', 'label'),
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "fixed_price",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_delivery_options.fixed_price"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "free_from_price",
                    "tabID"           => trans('HCTranslations::core.general'),
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers_delivery_options.free_from_price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => 'delivery',
                        ],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.label",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "translations.description",
                    "tabID"           => trans('HCTranslations::core.translations'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                    "rows"            => 5,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_title",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.seo_title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_description",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.seo_description"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "translations.seo_keywords",
                    "tabID"           => trans('HCTranslations::core.seo'),
                    "label"           => trans("HCECommerceGoods::e_commerce_categories.seo_keywords"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "multiLanguage"   => 1,
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