<?php

namespace interactivesolutions\honeycombecommercecarriers\app\http\controllers\ecommerce\carriers;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\carriers\HCECDeliveryCollectAddresses;
use interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce\carriers\HCECDeliveryCollectAddressesValidator;

class HCECDeliveryCollectAddressesController extends HCBaseController
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
            'title'       => trans('HCECommerceCarriers::e_commerce_carriers_collect_addresses.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.carriers.collect.addresses'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-carriers-collect-addresses-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-carriers-collect-addresses-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_collect_addresses_delete') )
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
            'delivery_option.translations.{lang}.label' => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_collect_addresses.delivery_option_id'),
            ],
            'name'               => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_collect_addresses.name'),
            ],
            'address'            => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers_collect_addresses.address'),
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

        $record = HCECDeliveryCollectAddresses::create(array_get($data, 'record'));

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
        $record = HCECDeliveryCollectAddresses::findOrFail($id);

        $data = $this->getInputData();

        $record->update(array_get($data, 'record', []));

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
        HCECDeliveryCollectAddresses::where('id', $id)->update(request()->all());

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
        HCECDeliveryCollectAddresses::destroy($list);

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
        HCECDeliveryCollectAddresses::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECDeliveryCollectAddresses::whereIn('id', $list)->restore();

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
        $with = ['delivery_option.translations'];

        if( $select == null )
            $select = HCECDeliveryCollectAddresses::getFillableFields();

        $list = HCECDeliveryCollectAddresses::with($with)->select($select)
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
            $query->where('delivery_option_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('name', 'LIKE', '%' . $phrase . '%')
                ->orWhere('address', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECDeliveryCollectAddressesValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.delivery_option_id', array_get($_data, 'delivery_option_id'));
        array_set($data, 'record.name', array_get($_data, 'name'));
        array_set($data, 'record.address', array_get($_data, 'address'));

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
        $with = [];

        $select = HCECDeliveryCollectAddresses::getFillableFields();

        $record = HCECDeliveryCollectAddresses::with($with)
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
