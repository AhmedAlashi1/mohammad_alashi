<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class OrderDataTable extends DataTable
{
    protected string $statusRoute = 'admin.orders.toggleStatus';

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user', fn($order) => $order->user?->name ?? '-')
            ->addColumn('payment_method', fn($order) => $order->paymentMethod?->name ?? '-')
//            ->editColumn('status', function ($order) {
//                return view('components.datatable.status-toggle', [
//                    'id' => $order->id,
//                    'status' => $order->status,
//                    'url' => route($this->statusRoute, $order->id),
//                ]);
//            })
            ->addColumn('action', function ($order) {
                return view('components.datatable.actions', [
                    'id' => $order->id,
//                    'routeEdit' => 'admin.orders.edit',
                    'routeDelete' => 'admin.orders.destroy',
                    'name' => $order->id,
                ]);
            })
            ->rawColumns(['status', 'action']);
    }

    public function query(Order $model)
    {
        return $model->newQuery()->with(['user', 'paymentMethod']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->addTableClass('table table-hover');
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('dataTable.id')),
            Column::make('user')->title(__('dataTable.user')),
            Column::make('total')->title(__('dataTable.total')),
            Column::make('payment_method')->title(__('dataTable.payment_method')),
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'orders_' . date('YmdHis');
    }
}
