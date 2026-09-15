<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class DeliveryAreaDataGrid extends DataGrid
{
    public function prepareQueryBuilder(): Builder
    {
        return DB::table('delivery_areas')
            ->select('id', 'name', 'postal_code', 'delivery_fee', 'active', 'sort_order');
    }

    public function prepareColumns(): void
    {
        $this->addColumn([
            'index' => 'name',
            'label' => trans('admin::app.delivery-areas.index.datagrid.name'),
            'type' => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable' => true,
        ]);

        $this->addColumn([
            'index' => 'postal_code',
            'label' => trans('admin::app.delivery-areas.index.datagrid.postal-code'),
            'type' => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable' => true,
        ]);

        $this->addColumn([
            'index' => 'delivery_fee',
            'label' => trans('admin::app.delivery-areas.index.datagrid.delivery-fee'),
            'type' => 'decimal',
            'filterable' => true,
            'sortable' => true,
        ]);

        $this->addColumn([
            'index' => 'active',
            'label' => trans('admin::app.delivery-areas.index.datagrid.status'),
            'type' => 'boolean',
            'filterable' => true,
            'filterable_options' => [
                [
                    'label' => trans('admin::app.delivery-areas.index.datagrid.active'),
                    'value' => 1,
                ],
                [
                    'label' => trans('admin::app.delivery-areas.index.datagrid.inactive'),
                    'value' => 0,
                ],
            ],
            'sortable' => true,
            'closure' => function ($value) {
                return $value->active
                    ? trans('admin::app.delivery-areas.index.datagrid.active')
                    : trans('admin::app.delivery-areas.index.datagrid.inactive');
            },
        ]);

        $this->addColumn([
            'index' => 'sort_order',
            'label' => trans('admin::app.delivery-areas.index.datagrid.sort-order'),
            'type' => 'integer',
            'filterable' => true,
            'sortable' => true,
        ]);
    }

    public function prepareActions(): void
    {
        if (bouncer()->hasPermission('delivery_areas.edit')) {
            $this->addAction([
                'icon' => 'icon-edit',
                'title' => trans('admin::app.delivery-areas.index.datagrid.edit'),
                'method' => 'GET',
                'url' => fn ($row) => route('admin.delivery_areas.edit', $row->id),
            ]);
        }

        if (bouncer()->hasPermission('delivery_areas.delete')) {
            $this->addAction([
                'icon' => 'icon-delete',
                'title' => trans('admin::app.delivery-areas.index.datagrid.delete'),
                'method' => 'DELETE',
                'url' => fn ($row) => route('admin.delivery_areas.delete', $row->id),
            ]);
        }
    }
}
