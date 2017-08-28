<?php

namespace interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers;

use interactivesolutions\honeycombcore\models\HCMultiLanguageModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;

class HCECDeliveryOptions extends HCMultiLanguageModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_carriers_delivery_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'carrier_id', 'type', 'fixed_price', 'free_from_price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(HCECCarriers::class, 'carrier_id', 'id');
    }
}