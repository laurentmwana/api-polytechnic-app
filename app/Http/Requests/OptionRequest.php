<?php

namespace App\Http\Requests;


class OptionRequest extends BaseFormRequest
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
}
