<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Http\Resources\Professor\ProfessorResource;
use App\Http\Resources\Professor\ProfessorsResource;
use App\Http\Resources\Professor\ProfessorUpdatResource;
use App\Models\Professor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminProfessorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $professors = Professor::with(['courses', 'department'])
            ->orderByDesc('updated_at')
            ->paginate();

        return ProfessorsResource::collection($professors);
    }

    public function show(int $id): ProfessorResource
    {
        $professor = Professor::with(['courses', 'department'])
            ->findOrFail($id);

        return new ProfessorResource($professor);
    }

    public function create(ProfessorRequest $request): ProfessorUpdatResource
    {
        $professor = DB::transaction(function () use ($request) {
            return Professor::create($request->validated());
        });

        return new ProfessorUpdatResource($professor);
    }

    public function update(ProfessorRequest $request, int $id): ProfessorUpdatResource
    {
        $professor = Professor::findOrFail($id);

        DB::transaction(function () use ($request, $professor) {
            $professor->update($request->validated());
        });

        return new ProfessorUpdatResource($professor);
    }

    public function destroy(int $id): bool|null
    {
        $professor = Professor::findOrFail($id);

        return DB::transaction(fn(): bool|null => $professor->delete());
    }
}
