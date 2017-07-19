<?php

namespace interactivesolutions\honeycombecommercecarriers\app\http\controllers\ecommerce;

use Illuminate\Database\Eloquent\Builder;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommercecarriers\app\validators\ecommerce\HCECCarriersValidator;

class HCECCarriersController extends HCBaseController
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
            'title'       => trans('HCECommerceCarriers::e_commerce_carriers.page_title'),
            'listURL'     => route('admin.api.routes.e.commerce.carriers'),
            'newFormUrl'  => route('admin.api.form-manager', ['e-commerce-carriers-new']),
            'editFormUrl' => route('admin.api.form-manager', ['e-commerce-carriers-edit']),
            'imagesUrl'   => route('resource.get', ['/']),
            'headers'     => $this->getAdminListHeader(),
        ];

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_create') )
            $config['actions'][] = 'new';

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_update') ) {
            $config['actions'][] = 'update';
            $config['actions'][] = 'restore';
        }

        if( auth()->user()->can('interactivesolutions_honeycomb_e_commerce_carriers_routes_e_commerce_carriers_delete') )
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
            'resource_id'        => [
                "type"  => "image",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.resource_id'),
            ],
            'label'              => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.label'),
            ],
            'slug'               => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.slug'),
            ],
            'max_package_width'  => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.max_package_width'),
            ],
            'max_package_height' => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.max_package_height'),
            ],
            'max_package_depth'  => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.max_package_depth'),
            ],
            'max_package_weight' => [
                "type"  => "text",
                "label" => trans('HCECommerceCarriers::e_commerce_carriers.max_package_weight'),
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

        $record = HCECCarriers::create(array_get($data, 'record'));

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
        $record = HCECCarriers::findOrFail($id);

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
        HCECCarriers::where('id', $id)->update(request()->all());

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
        HCECCarriers::destroy($list);

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
        HCECCarriers::onlyTrashed()->whereIn('id', $list)->forceDelete();

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
        HCECCarriers::whereIn('id', $list)->restore();

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
        $with = [];

        if( $select == null )
            $select = HCECCarriers::getFillableFields();

        $list = HCECCarriers::with($with)->select($select)
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
            $query->where('resource_id', 'LIKE', '%' . $phrase . '%')
                ->orWhere('label', 'LIKE', '%' . $phrase . '%')
                ->orWhere('slug', 'LIKE', '%' . $phrase . '%')
                ->orWhere('max_package_width', 'LIKE', '%' . $phrase . '%')
                ->orWhere('max_package_height', 'LIKE', '%' . $phrase . '%')
                ->orWhere('max_package_depth', 'LIKE', '%' . $phrase . '%')
                ->orWhere('max_package_weight', 'LIKE', '%' . $phrase . '%');
        });
    }

    /**
     * Getting user data on POST call
     *
     * @return mixed
     */
    protected function getInputData()
    {
        (new HCECCarriersValidator())->validateForm();

        $_data = request()->all();

        if( array_has($_data, 'id') )
            array_set($data, 'record.id', array_get($_data, 'id'));

        array_set($data, 'record.resource_id', array_get($_data, 'resource_id'));
        array_set($data, 'record.label', array_get($_data, 'label'));
        array_set($data, 'record.slug', array_get($_data, 'slug'));
        array_set($data, 'record.slug', generateHCSlug('carriers', array_get($_data, 'label')));
        array_set($data, 'record.max_package_width', array_get($_data, 'max_package_width'));
        array_set($data, 'record.max_package_height', array_get($_data, 'max_package_height'));
        array_set($data, 'record.max_package_depth', array_get($_data, 'max_package_depth'));
        array_set($data, 'record.max_package_weight', array_get($_data, 'max_package_weight'));

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

        $select = HCECCarriers::getFillableFields();

        $record = HCECCarriers::with($with)
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
