<?php

namespace App\Http\Requests;

use App\Helpers\MarkdownTransform;

class DepartmentRequest extends BaseFormRequest
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
            'name' => [
                'required',
                'string',
                'between:2,255',
            ],

            'faculty_id' => [
                'required',
                'exists:faculties,id'
            ],

            'description' => [
                'nullable',
                'string',
                'between:10,5000',
            ]
        ];
    }

    public function prepareForValidation()
    {
        $description = $this->input('description');

        if ($description !== null && !empty($description)) {
            $this->merge([
                'description' => MarkdownTransform::transform($description)
            ]);
        }
    }
}
