<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\Student\StudentResource;
use App\Http\Resources\Student\StudentsResource;
use App\Http\Resources\Student\StudentUpdateResource;
use App\Models\ActualLevel;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminStudentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $students = Student::with(['actualLevel', 'actualLevel.level', 'actualLevel.yearAcademic'])
            ->orderByDesc('updated_at')
            ->paginate();

        return StudentsResource::collection($students);
    }

    public function show(int $id): StudentResource
    {
        $student = Student::with(['actualLevel', 'actualLevel.level', 'actualLevel.yearAcademic'])
            ->findOrFail($id);

        return new StudentResource($student);
    }

    public function create(StudentRequest $request): StudentUpdateResource
    {
        $student = DB::transaction(function () use ($request) {
            $student  = Student::create($request->validated());

            ActualLevel::create([
                'student_id' => $student->id,
                'level_id' => $request->validated('level_id'),
                'year_academic_id' => $request->validated('year_academic_id'),
            ]);

            return $student;
        });

        return new StudentUpdateResource($student);
    }

    public function update(StudentRequest $request, int $id): StudentUpdateResource
    {
        $student = Student::with(['actualLevel'])->findOrFail($id);

        DB::transaction(function () use ($request, $student) {
            $student->update($request->validated());

            $student->actualLevel()->update([
                'level_id' => $request->validated('level_id'),
                'year_academic_id' => $request->validated('year_academic_id'),
            ]);
        });

        return new StudentUpdateResource($student);
    }

    public function destroy(int $id): bool|null
    {
        $student = Student::findOrFail($id);

        return DB::transaction(fn(): bool|null => $student->delete());
    }
}
