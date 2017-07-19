<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/carriers/delivery-options'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.delivery.options.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_force_delete'], 'uses' => 'ecommerce\\carriers\\HCECDeliveryOptionsController@apiForceDelete']);
        });
    });
});