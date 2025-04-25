<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\CoursesResource;
use App\Http\Resources\Course\CourseUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminCourseController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $courses = Course::with(['level', 'professor'])
            ->orderByDesc('updated_at')
            ->paginate();

        return CoursesResource::collection($courses);
    }

    public function show(int $id): CourseResource
    {
        $course = Course::with(['level', 'professor'])
            ->findOrFail($id);

        return new CourseResource($course);
    }

    public function create(CourseRequest $request): CourseUpdateResource
    {
        $course = DB::transaction(function () use ($request) {
            return Course::create($request->validated());
        });

        return new CourseUpdateResource($course);
    }

    public function update(CourseRequest $request, int $id): CourseUpdateResource
    {
        $course = Course::findOrFail($id);

        DB::transaction(function () use ($request, $course) {
            $course->update($request->validated());
        });

        return new CourseUpdateResource($course);
    }

    public function destroy(int $id): bool|null
    {
        $course = Course::findOrFail($id);

        return DB::transaction(fn(): bool|null => $course->delete());
    }
}
