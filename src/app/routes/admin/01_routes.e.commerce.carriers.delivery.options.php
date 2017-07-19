<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/carriers/delivery-options', ['as' => 'admin.routes.e.commerce.carriers.delivery.options.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/carriers/delivery-options'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.delivery.options.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiForceDelete']);
        });
    });
});
