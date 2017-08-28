<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/carriers/collect-addresses', ['as' => 'admin.routes.e.commerce.carriers.collect.addresses.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/carriers/collect-addresses'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.collect.addresses.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_list', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.collect.addresses.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryCollectAddressesController@apiForceDelete']);
        });
    });
});
