<?php

namespace App\DataTables;

use App\Models\LessonSection;
use App\Models\Subject;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

class LessonSectionDataTable extends DataTable
{
    protected string $statusRoute = 'admin.sections.toggleStatus';

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($section) {
                return view('components.datatable.actions', [
                    'id' => $section->id,
                    'subjectId' => $section->subject_id, // مهم لتمريره إلى المسارات
                    'nameUrl' =>'section',
                    'routeEdit' => 'admin.subjects.sections.edit',
                    'routeDelete' => 'admin.subjects.sections.destroy',
                    'name' => $section->name_ar,
                ]);
            })
            ->editColumn('status', function ($section) {
                return view('components.datatable.status-toggle', [
                    'id' => $section->id,
                    'status' => $section->status,
                    'url' => route($this->statusRoute, [$section->id]),
                ]);
            })
            ->addColumn('subject', function ($section) {
                return $section->subject?->name_ar ?? '-';
            })
            ->rawColumns(['action', 'status']);
    }

    public function query(LessonSection $model)
    {
        $subject = request()->route('subject');
        return $model->newQuery()
            ->where('subject_id', $subject->id)
            ->with('subject');
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
            Column::make('name_ar')->title(__('dataTable.name_ar')),
            Column::make('name_en')->title(__('dataTable.name_en')),
            Column::make('subject')->title(__('general.subject')),
            Column::make('status')->title(__('dataTable.status')),
            Column::computed('action')
                ->title(__('dataTable.action'))
                ->exportable(false)
                ->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'lesson_sections_' . date('YmdHis');
    }
}
