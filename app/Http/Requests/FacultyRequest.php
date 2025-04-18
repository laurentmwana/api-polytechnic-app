<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FacultyRequest extends FormRequest
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

            'university_id' => [
                'required',
                'exists:universities,id'
            ],

            'description' => [
                'nullable',
                'string',
                'between:10,5000',
            ]
        ];
    }

    public function wantsJson(): bool
    {
        return true;
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'La validation des données a échoué. Merci de corriger les champs concernés.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
