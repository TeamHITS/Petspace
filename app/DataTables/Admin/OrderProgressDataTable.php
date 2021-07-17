<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\OrderProgress;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class OrderProgressDataTable
 * @package App\DataTables\Admin
 */
class OrderProgressDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'admin.order_progresses.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OrderProgress $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OrderProgress $model)
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
        if (\Entrust::can('order-progresses.create') || \Entrust::hasRole('super-admin')) {
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
            'order_id',
            'progress_status',
            'date_time'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'order_progressesdatatable_' . time();
    }
}