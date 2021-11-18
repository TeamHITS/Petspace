<?php

namespace App\DataTables\Admin;

use App\Helper\Util;
use App\Models\CalendarSlots;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

/**
 * Class CalendarSlotsDataTable
 * @package App\DataTables\Admin
 */
class CalendarSlotsDataTable extends DataTable
{

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CalendarSlots $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CalendarSlots $model)
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
        if (\Entrust::can('calendar_slots.create') || \Entrust::hasRole('super-admin')) {
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
                'id'      => 'Id'
            ],
            'petspace_id'        => [
                'title'      => 'petspace_id',
                'searchable' => false
            ],
            'start_time'        => [
                'title'      => 'start_time',
                'searchable' => false
            ],
            'end_time'     => [
                'title'      => 'end_time',
                'searchable' => false
            ],
            'start_date' => [
                'title'      => 'start_date',
                'searchable' => false
            ]
,
            'status_text' => [
                'title'      => 'end_date',
                'searchable' => false
            ]

        ];
    }

 "petspace_id",
        "start_time",
        "end_time", 
        "start_date", 
        "end_date"
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'calendarslotstable' . time();
    }
}