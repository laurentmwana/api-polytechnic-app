<?php

namespace App\Http\Controllers\Admin;

use App\Models\Programme;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProgrammeRequest;
use App\Http\Resources\Programme\ProgrammeResource;
use App\Http\Resources\Programme\ProgrammesResource;
use App\Http\Resources\Programme\ProgrammeUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminProgrammeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $programmes = Programme::with(['levels'])
            ->orderByDesc('updated_at')
            ->paginate();

        return ProgrammesResource::collection($programmes);
    }

    public function store(ProgrammeRequest $request): ProgrammeUpdateResource
    {
        $programme = DB::transaction(function () use ($request) {
            return Programme::create($request->validated());
        });

        return new ProgrammeUpdateResource($programme);
    }

    public function show(int $id): ProgrammeResource
    {
        $programme = Programme::with(['levels'])
            ->findOrFail($id);

        return new ProgrammeResource($programme);
    }

    public function update(ProgrammeRequest $request, int $id): ProgrammeUpdateResource
    {
        $programme = Programme::findOrFail($id, ['name', 'id', 'alias']);

        DB::transaction(function () use ($request, $programme) {
            $programme->update($request->validated());
        });

        return new ProgrammeUpdateResource($programme);
    }


    public function destroy(int $id): bool|null
    {
        $programme = Programme::findOrFail($id);

        return DB::transaction(fn(): bool|null => $programme->delete());
    }
}
