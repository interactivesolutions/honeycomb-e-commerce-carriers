<?php

namespace interactivesolutions\honeycombecommercecarriers\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers\HCECDeliveryOptions;

class HCECCarriers extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_carriers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'resource_id', 'label', 'slug', 'max_package_width', 'max_package_height', 'max_package_depth', 'max_package_weight'];

    /**
     * Delivery options
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function delivery_options()
    {
        return $this->hasMany(HCECDeliveryOptions::class, 'carrier_id', 'id');
    }
}