<?php

namespace App\Http\Requests;

use App\Enum\GenderEnum;
use App\Rules\StudentInLevelRule;
use App\Rules\YearAcademicClosedRule;
use Illuminate\Validation\Rules\Enum;

class StudentRequest extends BaseFormRequest
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
        $yearId = $this->input('year_academic_id');
        $id = $this->input('id');

        return [
            'name' => [
                'required',
                'string',
                'between:2,255',
            ],

            'firstname' => [
                'required',
                'string',
                'between:2,255',
            ],

            'lastname' => [
                'required',
                'string',
                'between:2,255',
            ],

            'gender' => [
                'required',
                'string',
                (new Enum(GenderEnum::cases()))
            ],

            'birth' => [
                'required',
                'date'
            ],


            'year_academic_id' => [
                'required',
                'exists:year_academics,id',
                (new YearAcademicClosedRule())
            ],

            'level_id' => [
                'required',
                'exists:levels,id',
                (new StudentInLevelRule($yearId, $id))
            ],

        ];
    }
}
