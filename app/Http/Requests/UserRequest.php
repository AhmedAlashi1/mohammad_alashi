<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'           => ['required', 'string', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:20'],
            'phone2'         => ['nullable', 'string', 'max:20'],
            'age'            => ['nullable', 'integer', 'min:0'],
            'date_of_birth'  => ['nullable', 'date'],
            'gender'         => ['required', 'in:male,female'],
        ];
    }
}
