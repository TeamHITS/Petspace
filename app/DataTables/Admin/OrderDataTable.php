<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class OrderDataTable
 * @package App\DataTables\Admin
 */
class OrderDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from `query(`) method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query     = $query->with(['shop']);
        $dataTable = new EloquentDataTable($query);
        $dataTable->editColumn('shop', function (Order $model) {
            return $model->shop ? $model->shop->name : "";
        });
        $dataTable->editColumn('user', function (Order $model) {
            return $model->user ? $model->user->name : "";
        });
        $dataTable->editColumn('address', function (Order $model) {
            return $model->address ? $model->address->address : "";
        });

        $dataTable->rawColumns(['shop', 'user', 'address', 'action']);
        return $dataTable->addColumn('action', 'admin.orders.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
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
        if (\Entrust::can('orders.create') || \Entrust::hasRole('super-admin')) {
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
            'id'=> [
                'title'      => 'Order Id'
            ],
            'user'        => [
                'title'      => 'User',
                'searchable' => false
            ],
            'shop'        => [
                'title'      => 'Shop',
                'searchable' => false
            ],
            'address'     => [
                'title'      => 'Address',
                'searchable' => false
            ],
            'date_time',
            'status_text' => [
                'title'      => 'Status',
                'searchable' => false
            ]

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ordersdatatable_' . time();
    }
}