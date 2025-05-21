<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\CourseFollowed;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseFollow\CourseFollowResource;
use App\Http\Resources\CourseFollow\CourseFollowsResource;

class StudentCourseFollowController extends Controller
{
    public function index(Request $request)
    {
        $courseFollows = CourseFollowed::query()
            ->findSearchAndPaginated($request);

        return CourseFollowsResource::collection($courseFollows);
    }
    public function show(int $id)
    {
        $courseFollow = CourseFollowed::query()
            ->findByIdOrThrow($id);

        return new CourseFollowResource($courseFollow);
    }
}
