<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang = $request->header('lang', 'ar');
        $name = $lang === 'ar' ? $this->name_ar : $this->name_en;
        return [
            'id' => $this->id,
            'title' => $name ,
            'duration' => DurationFormatterMinutesAndSeconds($this->duration),
            'type' => $this->type,
            'video' => url($this->video),

        ];
    }
}
