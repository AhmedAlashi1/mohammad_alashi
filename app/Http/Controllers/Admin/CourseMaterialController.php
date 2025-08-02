<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CourseMaterialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseMaterialRequest;
use App\Models\CourseMaterial;
use App\Models\Subject;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Traits\HasStatusToggle;
use App\Services\VimeoService;

class CourseMaterialController extends Controller
{
    use HasStatusToggle , ImageTrait;

    public function index(CourseMaterialDataTable $dataTable, Subject $subject,$type)
    {
        //type lesson or note
        $type = $type ?? 'lesson'; // Default to 'lesson' if not provided

        return $dataTable->with('subject', $subject)->render('dashboard.admin.course_materials.index', [
            'subject' => $subject,
            'type' =>$type
        ]);
    }

    public function create(Subject $subject, Request $request)
    {
        $type = $request->route('type'); // Get type from route, default to 'lesson'
        $sections = $subject->lessonSections()->get();

        return view('dashboard.admin.course_materials.create', compact('subject', 'sections', 'type'));
    }

    public function store(CourseMaterialRequest $request, Subject $subject , VimeoService $vimeoService)
    {
        $data = $request->validated();

        if ($request->has('file')) {
            $data['file'] = $this->uploadImage('admin', $request->file);
        }
        if ($request->has('video')) {
//            $videoPath = $this->uploadImage('admin', $request->video);
//            $data['video'] = $videoPath;
            $videoFile = $request->file('video');

            $vimeoResult = $vimeoService->uploadVideo($request->file('video'));
            if ($vimeoResult) {
                $data['video'] = $vimeoResult['link'];
                $data['duration'] = $vimeoResult['duration'];
                $data['duration_text'] = gmdate("H:i:s", $vimeoResult['duration']);
            }
            return $vimeoResult;

//            $ffprobe = \FFMpeg\FFProbe::create();
//            $absolutePath = public_path($videoPath);

//            $durationInSeconds = (int) $ffprobe
//                ->format($absolutePath)
//                ->get('duration');

//            $data['duration'] = $durationInSeconds;
//            $data['duration_text'] = gmdate("H:i:s", $durationInSeconds);
        }

        $subject->courseMaterials()->create($data);

        return redirect()->route('admin.subjects.materials.index', [$subject->id,$data['type'] ?? 'lesson'])
            ->with('success', __('general.Created Successfully'));
    }

    public function edit(Subject $subject, CourseMaterial $material)
    {
        $type = $material->type;
        $sections = $subject->lessonSections()->get();

        return view('dashboard.admin.course_materials.edit', compact('subject', 'material', 'sections','type'));
    }

    public function update(CourseMaterialRequest $request, Subject $subject, CourseMaterial $material)
    {
        $data = $request->validated();

        if ($request->has('file')) {
            $data['file'] = $this->uploadImage('admin', $request->file);
        }
        if ($request->has('video')) {
            $videoPath = $this->uploadImage('admin', $request->video);
            $data['video'] = $videoPath;

            $ffprobe = \FFMpeg\FFProbe::create();
            $absolutePath = public_path($videoPath);

            $durationInSeconds = (int) $ffprobe
                ->format($absolutePath)
                ->get('duration');

            $data['duration'] = $durationInSeconds;
            $data['duration_text'] = gmdate("H:i:s", $durationInSeconds);
        }

        $material->update($data);

        return redirect()->route('admin.subjects.materials.index', [$subject->id,$data['type'] ?? 'lesson'])
            ->with('success', __('Updated Successfully'));
    }

    public function destroy(Subject $subject, CourseMaterial $material)
    {
        $material->delete();

        return response()->json(['status' => true]);
    }

    public function toggleStatus($materialId)
    {
        return $this->toggleStatu(CourseMaterial::class, $materialId);
    }
}
