<?php

namespace interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECDeliveryCollectAddresses extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_carriers_collect_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'delivery_option_id', 'name', 'address'];

    /**
     * Delivery option
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery_option()
    {
        return $this->belongsTo(HCECDeliveryOptions::class, 'delivery_option_id', 'id');
    }
}