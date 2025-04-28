<?php

namespace App\Http\Controllers\Admin;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Http\Resources\Professor\ProfessorResource;
use App\Http\Resources\Professor\ProfessorsResource;
use App\Http\Resources\Professor\ProfessorSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminProfessorController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $professors = Professor::query()->findSearchAndPaginated($request);

        return ProfessorsResource::collection($professors);
    }

    public function show(int $id): ProfessorResource
    {
        $professor = Professor::query()->findByIdOrThrow($id);

        return new ProfessorResource($professor);
    }

    public function store(ProfessorRequest $request): ProfessorSimpleResource
    {
        $professor = DB::transaction(function () use ($request) {
            return Professor::create($request->validated());
        });

        return new ProfessorSimpleResource($professor);
    }

    public function update(ProfessorRequest $request, int $id): ProfessorSimpleResource
    {
        $professor = Professor::findOrFail($id);

        DB::transaction(function () use ($request, $professor) {
            $professor->update($request->validated());
        });

        return new ProfessorSimpleResource($professor);
    }

    public function destroy(int $id): bool|null
    {
        $professor = Professor::findOrFail($id);

        return DB::transaction(fn(): bool|null => $professor->delete());
    }
}
