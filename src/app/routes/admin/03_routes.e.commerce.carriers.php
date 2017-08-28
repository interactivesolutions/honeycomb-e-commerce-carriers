<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('e-commerce/carriers', ['as' => 'admin.routes.e.commerce.carriers.index', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@adminIndex']);

    Route::group(['prefix' => 'api/e-commerce/carriers'], function ()
    {
        Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create'], 'uses' => 'ecommerce\\HCECCarriersController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.routes.e.commerce.carriers.list', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.routes.e.commerce.carriers.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.routes.e.commerce.carriers.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.force', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_force_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.routes.e.commerce.carriers.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list'], 'uses' => 'ecommerce\\HCECCarriersController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.routes.e.commerce.carriers.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update'], 'uses' => 'ecommerce\\HCECCarriersController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.routes.e.commerce.carriers.duplicate.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_list', 'acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create'], 'uses' => 'ecommerce\\HCECCarriersController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.routes.e.commerce.carriers.force.single', 'middleware' => ['acl:interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_force_delete'], 'uses' => 'ecommerce\\HCECCarriersController@apiForceDelete']);
        });
    });
});
