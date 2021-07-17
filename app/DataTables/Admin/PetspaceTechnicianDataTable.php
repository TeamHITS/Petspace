<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\PetspaceTechnician;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class PetspaceTechnicianDataTable
 * @package App\DataTables\Admin
 */
class PetspaceTechnicianDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query     = $query->with([ 'shop']);
        $dataTable = new EloquentDataTable($query);

        $dataTable->editColumn('user_id', function (PetspaceTechnician $model) {
            return $model->user ? $model->user->name : "";
        });
        $dataTable->editColumn('email', function (PetspaceTechnician $model) {
            return $model->user ? $model->user->email : "";
        });
        $dataTable->editColumn('phone', function (PetspaceTechnician $model) {
            return $model->user ? $model->user->details->phone : "";
        });

       /* $dataTable->editColumn('shop', function (PetspaceTechnician $model) {
            return $model->shop ? $model->shop->name : "";
        });*/

        $dataTable->rawColumns(['user_id', 'shop', 'action']);
        return $dataTable->addColumn('action', 'admin.petspace_technicians.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\PetspaceTechnician $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PetspaceTechnician $model)
    {
        if ($this->petspace_id != null) {
            return $model->newQuery()->where('petspace_id', $this->petspace_id);
        }
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
        if (\Entrust::can('petspace-technicians.create') || \Entrust::hasRole('super-admin')) {
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
            'user_id'        => [
                'title'      => 'User',
                'searchable' => false
            ],
            'email'        => [
                'title'      => 'Email',
                'searchable' => false
            ],
            'phone'        => [
                'title'      => 'Phone',
                'searchable' => false
            ],
//            'shop'        => [
//                'title'      => 'Shop',
//                'searchable' => false
//            ],
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
        return 'petspace_techniciansdatatable_' . time();
    }
}