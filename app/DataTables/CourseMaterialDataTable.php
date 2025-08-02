<?php

namespace App\DataTables;

use App\Models\CourseMaterial;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class CourseMaterialDataTable extends DataTable
{
    protected string $statusRoute = 'admin.subjects.materials.toggleStatus';

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($material) {
                return view('components.datatable.actions', [
                    'id' => $material->id,
                    'subjectId' => $material->subject_id,  // لتمرير معرّف المادة إلى الروت
                    'nameUrl' =>'material',
                    'routeEdit' => 'admin.subjects.materials.edit',
                    'routeDelete' => 'admin.subjects.materials.destroy',
                    'name' => $material->name_ar,
                ]);
            })
            ->editColumn('status', function ($material) {
                return view('components.datatable.status-toggle', [
                    'id' => $material->id,
                    'status' => $material->status,
                    'url' => route($this->statusRoute, [$material->id]),
                ]);
            })
            //is_free
            ->editColumn('is_free', function ($material) {
                //html
                if ($material->is_free) {
                    return '<span class="badge bg-success">' . __('general.Yes') . '</span>';
                } else {
                    return '<span class="badge bg-danger">' . __('general.No') . '</span>';
                }
            })
            ->editColumn('type', function ($material) {
                return $material->type == 'lesson' ? __('general.Lesson') : __('general.Note');
            })
            ->rawColumns(['action', 'status','is_free', 'type']);
    }

    public function query(CourseMaterial $model)
    {
        $subject = request()->route('subject');
        $type = request()->route('type'); // استلام قيمة الـ type من request (lesson أو note مثلاً)

        $query = $model->newQuery()->where('subject_id', $subject->id)
            ->where('type', $type);

//        if ($type && in_array($type, ['lesson', 'note'])) {
//            $query->where('type', $type);
//        }

        return $query->with('subject','section');
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
        $columns = [
            Column::make('id')->title(__('dataTable.id')),
            Column::make('name_ar')->title(__('dataTable.name_ar')),
            Column::make('name_en')->title(__('dataTable.name_en')),
//            Column::make('lesson_section')->title(__('general.lesson_sections')),
        ];
        if (request()->get('type') == 'lesson') {
            $columns[] = Column::make('duration')->title(__('general.Duration'));
        }
        $columns[] = Column::make('type')->title(__('dataTable.type'));
        //is_free

        $columns[] = Column::make('is_free')->title(__('general.is_free'));
        $columns[] = Column::make('status')->title(__('dataTable.status'));
        $columns[] = Column::computed('action')
            ->title(__('dataTable.action'))
            ->exportable(false)
            ->printable(false);
        return $columns;
    }

    protected function filename(): string
    {
        return 'course_materials_' . date('YmdHis');
    }
}
