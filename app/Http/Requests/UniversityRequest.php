<?php

namespace App\Http\Requests;

use App\Models\University;
use Illuminate\Validation\Rules\Unique;

class UniversityRequest extends BaseFormRequest
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
        $id = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
                (new Unique(University::class))->ignore($id)
            ]
        ];
    }
}
