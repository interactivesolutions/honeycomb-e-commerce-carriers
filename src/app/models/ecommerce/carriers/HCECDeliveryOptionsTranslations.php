<?php

namespace interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECDeliveryOptionsTranslations extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_carriers_delivery_options_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['record_id', 'language_code', 'description', 'label', 'slug', 'seo_title', 'seo_description', 'seo_keywords'];
}