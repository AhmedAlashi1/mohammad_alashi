<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\LessonSectionDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonSectionRequest;
use App\Models\LessonSection;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Traits\HasStatusToggle;

class LessonSectionController extends Controller
{
    use HasStatusToggle;

    public function index(LessonSectionDataTable $dataTable, Subject $subject)
    {
        return $dataTable->with('subject', $subject)->render('dashboard.admin.lesson_sections.index', [
            'subject' => $subject
        ]);
    }

    public function create(Subject $subject)
    {
        return view('dashboard.admin.lesson_sections.create', compact('subject'));
    }

    public function store(LessonSectionRequest $request, Subject $subject)
    {
        $subject->lessonSections()->create($request->validated());
        return redirect()->route('admin.subjects.sections.index', $subject->id)
            ->with('success', __('Section created successfully'));
    }

    public function edit(Subject $subject, LessonSection $section)
    {
        return view('dashboard.admin.lesson_sections.edit', compact('subject', 'section'));
    }

    public function update(LessonSectionRequest $request, Subject $subject, LessonSection $section)
    {
        $section->update($request->validated());
        return redirect()->route('admin.subjects.sections.index', $subject->id)
            ->with('success', __('Section updated successfully'));
    }

    public function destroy(Subject $subject, LessonSection $section)
    {
        $section->delete();
        return response()->json(['status' => true]);
    }

    public function toggleStatus($sectionId)
    {
        return $this->toggleStatu(LessonSection::class, $sectionId);
    }
}
