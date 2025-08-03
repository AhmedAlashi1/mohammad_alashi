<?php

namespace App\DataTables;

use App\Models\Payment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class PaymentsDataTable extends DataTable
{
    protected $examinationId;

    public function __construct($examinationId = null)
    {
        $this->examinationId = $examinationId;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($payment) {
                return view('components.datatable.actions', [
                    'id' => $payment->id,
                    'name' => $payment->examination_id,
                    'nameUrl' => 'payments',
                    'routeEdit' => 'admin.examinations.payments.edit',
                    'routeDelete' => 'admin.payments.destroy',

                    'routeParams' => [
                        'examination' => $payment->examination_id,
                        'payment' => $payment->id,
                    ],
                ]);
            })
            ->editColumn('payment_type', function ($payment) {
                return ucfirst($payment->payment_type);
            })
            ->editColumn('method', function ($payment) {
                return ucfirst($payment->method);
            })
            ->editColumn('amount', function ($payment) {
                return number_format($payment->amount, 2);
            })
            ->editColumn('created_at', function ($payment) {
                return $payment->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action']);
    }

    public function query(Payment $model)
    {
        $query = $model->newQuery()->with('user', 'examination');

        if ($this->examinationId) {
            $query->where('examination_id', $this->examinationId);
        }

        return $query;
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
        $columns = [
            Column::make('id')->title('#'),
            Column::make('amount')->title('Amount'),
            Column::make('payment_type')->title('Payment Type'),
            Column::make('method')->title('Method'),
            Column::make('notes')->title('Notes'),
            Column::make('created_at')->title('Created At'),
        ];

        if (!$this->examinationId) {
            array_splice($columns, 1, 0, [
                Column::make('user.name')->title('User Name'),
                Column::make('examination.exam_date')->title('Examination date'),
            ]);
        }

        $columns[] = Column::computed('action')
            ->title('Actions')
            ->exportable(false)
            ->printable(false)
            ->width(100)
            ->addClass('text-center');

        return $columns;
    }

    protected function filename(): string
    {
        return 'payments_' . date('YmdHis');
    }
}
