<?php

namespace App\DataTables;

use App\Models\Inventory;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class InventoriesDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($inventory) {
                $viewData = [
                    'id' => $inventory->id,
                    'name' => $inventory->description,
                    'nameUrl' => 'inventory',
                    'routeEdit' => 'admin.inventories.edit',
                    'routeDelete' => 'admin.inventories.destroy',
                ];
                return view('components.datatable.actions', $viewData);
            })
            ->editColumn('created_at', function ($inventory) {
                return $inventory->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action']);
    }

    public function query(Inventory $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('datatable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->addTableClass('table table-hover table-bordered');
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('#'),
            Column::make('description')->title('Description'),
            Column::make('code')->title('Code'),
            Column::make('purchase_price')->title('Purchase Price'),
            Column::make('quantity')->title('Quantity'),
            Column::make('created_at')->title('Created At'),
            Column::computed('action')
                ->title('Actions')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'inventories_' . date('YmdHis');
    }
}
