<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Department\DepartmentsResource;
use App\Http\Resources\Department\DepartmentSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminDepartmentController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $departments = Department::query()->findSearchAndPaginated($request);

        return DepartmentsResource::collection($departments);
    }

    public function store(DepartmentRequest $request): DepartmentSimpleResource
    {
        $department = DB::transaction(function () use ($request) {
            return Department::create($request->validated());
        });

        return new DepartmentSimpleResource($department);
    }

    public function show(int $id): DepartmentResource
    {
        $department = Department::query()->findByIdOrThrow($id);

        return new DepartmentResource($department);
    }

    public function update(DepartmentRequest $request, int $id): DepartmentSimpleResource
    {
        $department = Department::findOrFail($id);

        DB::transaction(function () use ($request, $department) {
            $department->update($request->validated());
        });

        return new DepartmentSimpleResource($department);
    }

    public function destroy(int $id): bool|null
    {
        $department = Department::findOrFail($id);

        return DB::transaction(fn(): bool|null => $department->delete());
    }
}
