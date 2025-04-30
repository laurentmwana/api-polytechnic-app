<?php

namespace App\Http\Requests;

use App\Rules\CourseInLevelRule;

class CourseRequest extends BaseFormRequest
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
        $levelId = $this->input('level_id');

        $id = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
                (new CourseInLevelRule($levelId, $id))
            ],

            'credits' => [
                'required',
                'numeric',
                'min:1',
                'max:30'
            ],

            'level_id' => [
                'required',
                'exists:levels,id',
            ],

            'professor_id' => [
                'required',
                'exists:professors,id',
            ],
        ];
    }
}
