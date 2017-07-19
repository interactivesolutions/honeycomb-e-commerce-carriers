<?php

namespace interactivesolutions\honeycombecommercecarriers\app\providers;

use interactivesolutions\honeycombcore\providers\HCBaseServiceProvider;

class HCECommerceCarriersServiceProvider extends HCBaseServiceProvider
{
    protected $homeDirectory = __DIR__;

    protected $commands = [];

    protected $namespace = 'interactivesolutions\honeycombecommercecarriers\app\http\controllers';

    public $serviceProviderNameSpace = 'HCECommerceCarriers';
}





