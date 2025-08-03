<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class UsersDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($user) {
                $viewData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nameUrl' => 'user'

                ];
                    $viewData['routeEdit'] = 'admin.users.edit';
                    $viewData['routeDelete'] = 'admin.users.destroy';
                    $viewData['routeExaminations'] = 'admin.users.examinations';
                return view('components.datatable.actions', $viewData);

            })

            ->addColumn('created_at', function ($user) {
                return $user->created_at->format('Y-m-d H:i');
            })
            ->addColumn('gender', function ($user) {
                $label = $user->gender === 'male'
                    ? '<span class="badge"style="background-color:#119bfa;" >Male</span>'
                    : '<span class="badge" style="background-color:#f472b6;">Female</span>';
                return $label;
            })
            //status 1 == active 2 == pending 0 == inactive
            ->addColumn('status', function ($user) {
                return $user->status == 1 ? __('dataTable.active') : ($user->status == 2 ? __('dataTable.pending') : __('dataTable.inactive'));
            })
            ->filter(function ($query) {
                if (request()->has('search') && $search = request('search')['value']) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%")
                            ->orWhere('gender', 'like', "%{$search}%");
                    });
                }
            })

            ->rawColumns(['action', 'gender']);
    }

    public function query(User $model)
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
            ->addTableClass('table table-hover');
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title(__('dataTable.id')),
            Column::make('name')->title(__('dataTable.name')),
            Column::make('phone')->title(__('dataTable.phone')),
            Column::make('gender')->title(__('gender')),
            Column::make('created_at')->title(__('dataTable.created_at')),
            Column::computed('action')->title(__('dataTable.action'))->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'schools_' . date('YmdHis');
    }
}

