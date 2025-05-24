<?php

namespace App\Http\Controllers\Other;

use App\Models\Option;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluatorController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([
            'data' => [
                'departments' => $this->getCountDepartments(),
                'options' => $this->getCountOptions(),
                'students' => $this->getCountStudents(),
                'professors' => $this->getCountProfessors(),
            ]
        ]);
    }

    private function getCountDepartments(): int
    {
        return Department::count('id');
    }

    private function getCountOptions(): int
    {
        return Option::count('id');
    }


    private function getCountStudents(): int
    {
        return Student::count('id');
    }

    private function getCountProfessors(): int
    {
        return Professor::count('id');
    }
}
