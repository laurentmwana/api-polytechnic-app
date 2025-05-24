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
        $limit = $request->query->getInt('limit');

        $departments = null !== $limit && $limit > 0
            ? Department::query()->findLimit($limit)
            : Department::query()->findSearchAndPaginated($request);

        return DepartmentsResource::collection($departments);
    }

    public function show(int $id): DepartmentResource
    {
        $department = Department::query()->findByIdOrThrow($id);

        return new DepartmentResource($department);
    }
}
