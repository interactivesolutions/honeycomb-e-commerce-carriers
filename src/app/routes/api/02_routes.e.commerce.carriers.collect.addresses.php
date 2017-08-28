<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/carriers/collect-addresses'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiForceDelete']);
        });
    });
});