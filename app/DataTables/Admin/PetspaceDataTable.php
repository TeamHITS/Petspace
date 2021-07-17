<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\Petspace;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class PetspaceDataTable
 * @package App\DataTables\Admin
 */
class PetspaceDataTable extends DataTable
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
        $dataTable->editColumn('grooming', function (Petspace $model) {
            return $model->grooming_text ? $model->grooming_text : "";
        });

        $dataTable->rawColumns(['grooming', 'action']);
        return $dataTable->addColumn('action', 'admin.petspaces.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Petspace $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Petspace $model)
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
        if (\Entrust::can('petspaces.create') || \Entrust::hasRole('super-admin')) {
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
            'name',
            'grooming',
            'address',
            'email',
            'phone',
//            'delivery_fee',
//            'rating'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'petspacesdatatable_' . time();
    }
}