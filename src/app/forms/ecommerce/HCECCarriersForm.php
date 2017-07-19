<?php

namespace interactivesolutions\honeycombecommercecarriers\app\forms\ecommerce;

class HCECCarriersForm
{
    // name of the form
    protected $formID = 'e-commerce-carriers';

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
            'storageURL' => route('admin.api.routes.e.commerce.carriers'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "resource",
                    "fieldID"         => "resource_id",
                    "uploadURL"       => route("admin.api.resources"),
                    "viewURL"         => route("resource.get", ['/']),
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.resource_id"),
                    "fileCount"       => 1,
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "label",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.label"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "max_package_width",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.max_package_width"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "max_package_height",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.max_package_height"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "max_package_depth",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.max_package_depth"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "max_package_weight",
                    "label"           => trans("HCECommerceCarriers::e_commerce_carriers.max_package_weight"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        $form['structure'][] = [
            "type"            => "singleLine",
            "fieldID"         => "slug",
            "label"           => trans("HCECommerceCarriers::e_commerce_carriers.slug"),
            "readonly"        => 1,
            "required"        => 1,
            "requiredVisible" => 1,
        ];


        return $form;
    }
}