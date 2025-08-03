<?php

namespace App\DataTables;

use App\Models\Examination;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class ExaminationsDataTable extends DataTable
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($examination) {
                $viewData = [
                    'id' => $examination->id,
                    'userId' => $examination->user_id,
                    'name' => $examination->name,
                    'nameUrl' => 'examination',
                    'routeEdit' => 'admin.users.examinations.edit',
                    'routeDelete' => 'admin.examinations.destroy',
                    //routePayments
                    'routePayments' => 'admin.examinations.payments',
                    'routeParams' => [
                        'user' => $examination->user_id,
                        'examination' => $examination->id,
                    ],
                ];
                if ($examination->exam_type === 'consultation_with_glasses') {
                    $viewData['routePrescription'] = 'admin.users.examinations.prescription';
                }

                return view('components.datatable.actions_examinations', $viewData);
            })
            ->editColumn('exam_type', function ($examination) {
                return $examination->exam_type === 'consultation' ? 'Consultation' : 'Consultation with Glasses';
            })
            ->editColumn('exam_date', function ($examination) {
                return $examination->exam_date;
            })
            ->editColumn('created_at', function ($examination) {
                return $examination->created_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action']);
    }

    public function query(Examination $model)
    {
        $query = $model->newQuery()->with('user');

        if ($this->userId) {
            $query->where('user_id', $this->userId);
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
            Column::make('exam_date')->title('Exam Date'),
            Column::make('day')->title('Day'),
            Column::make('exam_type')->title('Exam Type'),
            Column::make('created_at')->title('Created At'),
        ];
        if (!$this->userId) {
            array_splice($columns, 1, 0, [
                Column::make('user.name')->title('User Name'),
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
        return 'examinations_' . date('YmdHis');
    }
}
