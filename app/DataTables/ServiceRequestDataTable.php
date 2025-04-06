<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Batch;
use App\Models\Meeting;
use App\Facades\UtilityFacades;
use App\Models\ServiceRequest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceRequestDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('user_id', function (ServiceRequest $srequest) {
                return  $srequest->user->name;
            })
            ->editColumn('service_id', function (ServiceRequest $srequest) {
                return  $srequest->service? $srequest->service->title :"";
            })
            ->setRowAttr([
                'user' => function (ServiceRequest $srequest) {
                    return $srequest->user->name;
                },
                'service' => function (ServiceRequest $srequest) {
                    return $srequest->service->title;
                },
            ])
            ->addColumn('action', function (ServiceRequest $srequest) {
                return view('service-request.action', compact('srequest'));
            });
    }


    public function query(ServiceRequest $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('meeting-table')
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
            Column::make('order_id'),
            Column::make('user_id')->title('User'),
            Column::make('service_id')->title('Service'),
            Column::make('price'),
            Column::make('payment_status'),
            Column::make('status')->title('Employee'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(50)
                ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'ServiceRequests_' . date('YmdHis');
    }
}
