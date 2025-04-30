<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\ActualLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\Student\StudentResource;
use App\Http\Resources\Student\StudentsResource;
use App\Http\Resources\Student\StudentSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminStudentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $students = Student::query()->findSearchAndPaginated($request);

        return StudentsResource::collection($students);
    }

    public function show(int $id): StudentResource
    {
        $student = Student::query()->findByIdOrThrow($id);

        return new StudentResource($student);
    }

    public function store(StudentRequest $request): StudentSimpleResource
    {
        $student = DB::transaction(function () use ($request) {
            $student  = Student::create([
                ...$request->validated(),
                'registration_token' => Str::random(10),
            ]);

            ActualLevel::create([
                'student_id' => $student->id,
                'level_id' => $request->validated('level_id'),
                'year_academic_id' => $request->validated('year_academic_id'),
            ]);

            return $student;
        });

        return new StudentSimpleResource($student);
    }

    public function update(StudentRequest $request, int $id): StudentSimpleResource
    {
        $student = Student::with(['actualLevel'])->findOrFail($id);

        DB::transaction(function () use ($request, $student) {
            $student->update($request->validated());

            $student->actualLevel()->update([
                'level_id' => $request->validated('level_id'),
                'year_academic_id' => $request->validated('year_academic_id'),
            ]);
        });

        return new StudentSimpleResource($student);
    }

    public function destroy(int $id): bool|null
    {
        $student = Student::findOrFail($id);

        return DB::transaction(fn(): bool|null => $student->delete());
    }
}
