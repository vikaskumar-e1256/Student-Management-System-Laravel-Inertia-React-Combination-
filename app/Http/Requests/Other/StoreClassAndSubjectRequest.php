<?php

namespace App\Http\Requests\Other;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassAndSubjectRequest extends FormRequest
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
            'classes_id' => 'required|exists:classes,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'classes_id.required' => 'This field is required.',
            'subject_ids.required' => 'This field is required.'
        ];
    }
}
