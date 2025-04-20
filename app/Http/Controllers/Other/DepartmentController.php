<?php

namespace App\Http\Controllers\Other;

use App\Models\Department;
use App\Http\Controllers\Controller;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Department\DepartmentsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $departments = Department::with(['faculty'])
            ->orderByDesc('updated_at')
            ->paginate();

        return DepartmentsResource::collection($departments);
    }

    public function show(int $id): DepartmentResource
    {
        $department = Department::with(['faculty'])
            ->findOrFail($id);

        return new DepartmentResource($department);
    }
}
