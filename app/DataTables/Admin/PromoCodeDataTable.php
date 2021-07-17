<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\PromoCode;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class PromoCodeDataTable
 * @package App\DataTables\Admin
 */
class PromoCodeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $dataTable->editColumn('valid_from', function (PromoCode $model) {
            return $model->valid_from ? date('d M Y',strtotime($model->valid_from)) : "";
        });
        $dataTable->editColumn('valid_to', function (PromoCode $model) {
            return $model->valid_to ? date('d M Y',strtotime($model->valid_to)) : "";
        });
        $dataTable->editColumn('discount_percentage', function (PromoCode $model) {
            return $model->discount_percentage ? $model->discount_percentage."%" : "";
        });
        return $dataTable->addColumn('action', 'admin.promo_codes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PromoCode $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PromoCode $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $buttons = [];
        if (\Entrust::can('promo-codes.create') || \Entrust::hasRole('super-admin')) {
            $buttons = ['create'];
        }
        $buttons = array_merge($buttons, [
            'export',
//            'print',
//            'reset',
//            'reload',
        ]);
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px', 'printable' => false])
            ->parameters(array_merge(Util::getDataTableParams(), [
                'dom'     => 'Blfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => $buttons,
            ]));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'code',
            'discount_percentage',
            'valid_from',
            'valid_to'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'promo_codesdatatable_' . time();
    }
}