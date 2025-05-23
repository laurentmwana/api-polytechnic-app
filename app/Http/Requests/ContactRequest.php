<?php

namespace App\Http\Requests;

class ContactRequest extends BaseFormRequest
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
                'between:2,40',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'lowercase'
            ],

            'subject' => [
                'required',
                'string',
                'between:2,255',
            ],

            'message' => [
                'required',
                'string',
                'between:10,5000',
            ],
        ];
    }
}
