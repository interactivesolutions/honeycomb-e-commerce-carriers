<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/e-commerce/carriers'], function ()
    {
        Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create'], 'uses' => 'ecommerce\\HCECCarriersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiList']);
            Route::get('{timestamp}', ['as' => 'api.v1.routes.e.commerce.carriers.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.routes.e.commerce.carriers.restore', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.merge', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.force', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_force_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.routes.e.commerce.carriers.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.routes.e.commerce.carriers.update.strict', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.routes.e.commerce.carriers.duplicate.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list', 'acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create'], 'uses' => 'ecommerce\\HCECCarriersController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.routes.e.commerce.carriers.force.single', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_force_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiForceDelete']);
        });
    });
});