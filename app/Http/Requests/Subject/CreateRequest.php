<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|string|unique:subjects',
            'languages' => 'required|array',
            'languages.*' => 'exists:languages,id',
            'classes_id' => 'required|array',
            'classes_id.*' => 'exists:classes,id',
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
            'classes_id.required' => 'Please choose the class.',
            'classes_id.exists' => 'Do not be sneaky! Class Does not exist in our portal.',
        ];
    }
}
