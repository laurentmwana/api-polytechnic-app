<?php

namespace App\Http\Requests;

use App\Models\University;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OptionRequest extends FormRequest
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
            ],

            'alias' => [
                'required',
                'string',
                'between:2,10',
            ],

            'description' => [
                'nullable',
                'string',
                'between:2,50000',
            ],

            'department_id' => [
                'required',
                'exists:departments,id'
            ],
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
