<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\CoursesResource;
use App\Http\Resources\Course\CourseSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminCourseController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $courses = Course::query()->findSearchAndPaginated($request);

        return CoursesResource::collection($courses);
    }

    public function show(int $id): CourseResource
    {
        $course = Course::query()->findByIdOrThrow($id);

        return new CourseResource($course);
    }

    public function store(CourseRequest $request): CourseSimpleResource
    {
        $course = DB::transaction(function () use ($request) {
            return Course::create($request->validated());
        });

        return new CourseSimpleResource($course);
    }

    public function update(CourseRequest $request, int $id): CourseSimpleResource
    {
        $course = Course::findOrFail($id);

        DB::transaction(function () use ($request, $course) {
            $course->update($request->validated());
        });

        return new CourseSimpleResource($course);
    }

    public function destroy(int $id): bool|null
    {
        $course = Course::findOrFail($id);

        return DB::transaction(fn(): bool|null => $course->delete());
    }
}
