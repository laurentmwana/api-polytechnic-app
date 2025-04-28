<?php

namespace App\Http\Controllers\Other;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Department\DepartmentsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $departments = Department::query()->findSearchAndPaginated($request);

        return DepartmentsResource::collection($departments);
    }

    public function show(int $id): DepartmentResource
    {
        $department = Department::query()->findByIdThrow($id);

        return new DepartmentResource($department);
    }
}
