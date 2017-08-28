<?php

namespace interactivesolutions\honeycombecommercecarriers\app\http\controllers\ecommerce\carriers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers\HCECDeliveryOptions;
use interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce\carriers\HCECDeliveryOptionsValidator;

class HCECDeliveryOptionsController extends HCBaseController
{

    //TODO recordsPerPage setting

    /**
     * Returning configured admin view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminIndex()
    {
        $config = [
            'title'       => trans('HCECommerceCarriers::e_commerce_carriers_delivery_options.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.carriers.delivery.options'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-carriers-delivery-options-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-carriers-delivery-options-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delivery_options_delete') )
            $config['actions'][] = 'delete';

        $config['actions'][] = 'search';
        $config['filters'] = $this->getFilters();

        return hcview('HCCoreUI::admin.content.list', ['config' => $config]);
    }

    /**
     * Creating Admin List Header based on Main Table
     *
     * @return array
     */
    public function getAdminListHeader()
    {
        return [
            'carrier.label'  => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_delivery_options.carrier_id'),
            ],
            'type'        => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_delivery_options.type'),
            ],
            'fixed_price' => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_delivery_options.fixed_price'),
            ],

        ];
    }

    /**
     * Create item
     *
     * @return mixed
     */
    protected function __apiStore()
    {
        $data = $this->getInputData();

        $record = HCECDeliveryOptions::create(array_get($data, 'record'));
        $record->updateTranslations(array_get($data, 'translations'));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing item based on ID
     *
     * @param $id
     * @return mixed
     */
    protected function __apiUpdate(string $id)
    {
        $record = HCECDeliveryOptions::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));
        $record->updateTranslations(array_get($data, 'translations', []));

        return $this->apiShow($record->id);
    }

    /**
     * Updates existing specific items based on ID
     *
     * @param string $id
     * @return mixed
     */
    protected function __apiUpdateStrict(string $id)
    {
        HCECDeliveryOptions::where('id', $id)->update(request()->all());

        return $this->apiShow($id);
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiDestroy(array $list)
    {
        HCECDeliveryOptions::destroy($list);

        return hcSuccess();
    }

    /**
     * Delete records table
     *
     * @param $list
     * @return mixed
     */
    protected function __apiForceDelete(array $list)
    {
        HCECDeliveryOptions::onlyTrashed()->whereIn('id', $list)->forceDelete();

        return hcSuccess();
    }

    /**
     * Restore multiple records
     *
     * @param $list
     * @return mixed
     */
    protected function __apiRestore(array $list)
    {
        HCECDeliveryOptions::whereIn('id', $list)->restore();

        return hcSuccess();
    }

    /**
     * Creating data query
     *
     * @param array $select
     * @return mixed
     */
    protected function createQuery(array $select = null)
    {
        $with = ['carrier'];

        if( $select == null )
            $select = HCECDeliveryOptions::getFillableFields();

        $list = HCECDeliveryOptions::with($with)->select($select)
            // add filters
            ->where(function ($query) use ($select) {
                $query = $this->getRequestParameters($query, $select);
            });

        // enabling check for deleted
        $list = $this->checkForDeleted($list);

        // add search items
        $list = $this->search($list);

        // ordering data
        $list = $this->orderData($list, $select);

        return $list;
    }

    /**
     * List search elements
     * @param Builder $query
     * @param string $phrase
     * @return Builder
     */
    protected function searchQuery(Builder $query, string $phrase)
    {
        return $query->where(function (Builder $query) use ($phrase) {
            $query->where('carrier_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('type', 'LIKE', '%' . $phrase . '%')
                ->orWhere('fixed_price', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECDeliveryOptionsValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.carrier_id', array_get($_data, 'carrier'));
        array_set($data, 'record.type', array_get($_data, 'type'));
        array_set($data, 'record.fixed_price', array_get($_data, 'fixed_price'));
        array_set($data, 'translations', array_get($_data, 'translations'));

        return $data;
    }

    /**
     * Getting single record
     *
     * @param $id
     * @return mixed
     */
    public function apiShow(string $id)
    {
        $with = ['carrier', 'translations'];

        $select = HCECDeliveryOptions::getFillableFields();

        $record = HCECDeliveryOptions::with($with)
            ->select($select)
            ->where('id', $id)
            ->firstOrFail();

        return $record;
    }

    /**
     * Generating filters required for admin view
     *
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        return $filters;
    }
}
