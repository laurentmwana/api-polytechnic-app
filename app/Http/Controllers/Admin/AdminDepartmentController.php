<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Department\DepartmentsResource;
use App\Http\Resources\Department\DepartmentUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminDepartmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $departments = Department::with(['faculty'])
            ->orderByDesc('updated_at')
            ->paginate();

        return DepartmentsResource::collection($departments);
    }

    public function store(DepartmentRequest $request): DepartmentUpdateResource
    {
        $department = DB::transaction(function () use ($request) {
            return Department::create($request->validated());
        });

        return new DepartmentUpdateResource($department);
    }

    public function show(int $id): DepartmentResource
    {
        $department = Department::with(['faculty'])
            ->findOrFail($id);

        return new DepartmentResource($department);
    }

    public function update(DepartmentRequest $request, int $id): DepartmentUpdateResource
    {
        $department = Department::findOrFail($id, ['name', 'id']);

        DB::transaction(function () use ($request, $department) {
            $department->update($request->validated());
        });

        return new DepartmentUpdateResource($department);
    }


    public function destroy(int $id): bool|null
    {
        $department = Department::findOrFail($id);

        return DB::transaction(fn(): bool|null => $department->delete());
    }
}
