<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو أي صلاحية حسب نظامك
    }

    public function rules(): array
    {
        $rules = [
            'exam_date' => ['required', 'date'],
            'exam_type' => ['required', 'in:consultation,consultation_with_glasses'],
        ];

        // إذا كان الفحص مع نظارة، نضيف قواعد النظارة
        if ($this->input('exam_type') === 'consultation_with_glasses') {
            $rules = array_merge($rules, [
                'sph_od' => ['nullable', 'string'],
                'cyl_od' => ['nullable', 'string'],
                'axis_od' => ['nullable', 'string'],
                'add_od' => ['nullable', 'string'],
                'prism_od' => ['nullable', 'string'],
                'sci_od' => ['nullable', 'string'],

                'sph_os' => ['nullable', 'string'],
                'cyl_os' => ['nullable', 'string'],
                'axis_os' => ['nullable', 'string'],
                'add_os' => ['nullable', 'string'],
                'prism_os' => ['nullable', 'string'],
                'sci_os' => ['nullable', 'string'],

                'ipd' => ['nullable', 'string'],
                'notes' => ['nullable', 'string'],

                'lens_type' => ['nullable', 'string'],
                'lens_purchase_price' => ['nullable', 'numeric'],
                'lens_selling_price' => ['nullable', 'numeric'],
                'inventory_id' => ['nullable', 'exists:inventories,id'],
                'frame_price' => ['nullable', 'numeric'],
                'other_costs' => ['nullable', 'numeric'],
                'consultation_cost' => ['nullable', 'numeric'],
                'total_cost' => ['nullable', 'numeric'],
            ]);
        }

        return $rules;
    }
}
