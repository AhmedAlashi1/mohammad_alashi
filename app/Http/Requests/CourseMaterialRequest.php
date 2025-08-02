<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject_id'         => ['required', 'exists:subjects,id'],
            'lesson_section_id'  => ['required', 'exists:lesson_sections,id'],
            'name_ar'            => ['required', 'string', 'max:255'],
            'name_en'            => ['required', 'string', 'max:255'],
            'duration'           => ['nullable', 'string', 'max:100'],
//            'video'             => ['nullable', 'file', 'max:20480'], // 20MB
            'video' => ['nullable', 'file', 'mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime', 'max:20480'],
            'file'               => ['nullable', 'file', 'max:20480'], // 20MB
            'status'             => ['nullable', 'boolean'],
            'type'               => ['required', 'in:lesson,note'],
            'is_free'            => ['nullable', 'boolean'],
        ];
    }
}
