<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\CourseFollowed;
use App\Http\Controllers\Controller;

class StudentCourseFollowController extends Controller
{

    public function index(Request $request)
    {
        $courseFollows = CourseFollowed::query()
            ->findSearchAndPaginated($request);
    }

    public function show() {}

    public function destroy() {}
}
