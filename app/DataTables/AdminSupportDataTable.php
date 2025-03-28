<?php

namespace App\DataTables;

use App\Models\Meeting;
use App\Models\Support;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminSupportDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function (Support $support) {
                return  $support->user->name;
            })
            ->setRowAttr([
                'user' => function (Support $support) {
                    return $support->user->name;
                },
            ])
            ->addColumn('action', function (Support $support) {
                return view('support.action', compact('support'));
            });
    }


    public function query(Support $model)
    {
        return $model->newQuery()->where('parent_id',null)->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('support-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->language([
                "paginate" => [
                    "next" => '<i class="fas fa-angle-right"></i>',
                    "previous" => '<i class="fas fa-angle-left"></i>'
                ]
            ])
            ->parameters([
                "dom" =>  "
                                <'row'<'col-sm-12'><'col-sm-9'B><'col-sm-3'f>>
                                <'row'<'col-sm-12'tr>>
                                <' row mt-3 container-fluid'<'col-sm-5'i><'col-sm-7'p>>
                                ",

                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner ',],
                    ['extend' => 'export', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-primary btn-sm no-corner',],
                    ['extend' => 'pageLength', 'className' => 'btn btn-primary btn-sm no-corner',],
                ],

                "scrollX" => true
            ])
            ->language([
                'buttons' => [
                    'create' => __('Create'),
                    'export' => __('Export'),
                    'print' => __('Print'),
                    'reset' => __('Reset'),
                    'reload' => __('Reload'),
                    'excel' => __('Excel'),
                    'csv' => __('CSV'),
                    'pageLength' => __('Show %d rows'),
                ]
            ]);
    }



    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('subject'),
            Column::make('user_id')->title('User'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(50)
                ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'Supports_' . date('YmdHis');
    }
}
