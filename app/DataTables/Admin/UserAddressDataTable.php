<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\UserAddress;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class UserAddressDataTable
 * @package App\DataTables\Admin
 */
class UserAddressDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.user_addresses.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserAddress $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserAddress $model)
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
        if (\Entrust::can('user-addresses.create') || \Entrust::hasRole('super-admin')) {
            $buttons = ['create'];
        }
        $buttons = array_merge($buttons, [
            'export',
            'print',
            'reset',
            'reload',
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
            'id',
            'user_id',
            'type',
            'address'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'user_addressesdatatable_' . time();
    }
}