<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\DurationFormatter;

class SubjectDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = auth()->user();
        $lang = $request->header('lang', 'ar');

        $courseMaterials = $this->courseMaterials;

        // تجميع الأقسام ومحتواها
        $sections = $courseMaterials
            ->groupBy('lesson_section_id')
            ->map(function ($materials, $sectionId) use ($lang) {
                return [
                    'id' => $sectionId,
                    'name' => optional($materials->first()->section)->{"name_$lang"},
                    'lessons' => LessonResource::collection(
                        $materials->where('type', 'lesson')
                    ),
                    'notes' => NoteResource::collection(
                        $materials->where('type', 'note')
                    ),
                ];
            })->values();

        // التحقق من الاشتراك
        $isPurchased = $this->orders()
            ->where('user_id', $user?->id)
            ->where('status', 'paid')
            ->exists();

        return [
            'id' => $this->id,
            'name' => $lang === 'ar' ? $this->name_ar : $this->name_en,
            'image' => $this->image ? asset($this->image) : null,
            'total_lessons' => $courseMaterials->where('type', 'lesson')->count(),
            'total_duration' => DurationFormatter(
                $courseMaterials->where('type', 'lesson')->sum('duration'),
                $lang
            ),
            'price' => number_format($this->price, 3),
            'is_purchased' => $isPurchased,
            'sections' => $sections,
        ];
    }
}
