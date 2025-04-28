<?php

namespace App\Http\Controllers\Admin;

use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProgrammeRequest;
use App\Http\Resources\Programme\ProgrammeResource;
use App\Http\Resources\Programme\ProgrammesResource;
use App\Http\Resources\Programme\ProgrammeSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminProgrammeController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $programmes = Programme::query()->findSearchOrThrow($request);

        return ProgrammesResource::collection($programmes);
    }

    public function store(ProgrammeRequest $request): ProgrammeSimpleResource
    {
        $programme = DB::transaction(function () use ($request) {
            return Programme::create($request->validated());
        });

        return new ProgrammeSimpleResource($programme);
    }

    public function show(int $id): ProgrammeResource
    {
        $programme = Programme::query()->findByIdOrThrow($id);

        return new ProgrammeResource($programme);
    }

    public function update(ProgrammeRequest $request, int $id): ProgrammeSimpleResource
    {
        $programme = Programme::findOrFail($id, ['name', 'id', 'alias']);

        DB::transaction(function () use ($request, $programme) {
            $programme->update($request->validated());
        });

        return new ProgrammeSimpleResource($programme);
    }


    public function destroy(int $id): bool|null
    {
        $programme = Programme::findOrFail($id);

        return DB::transaction(fn(): bool|null => $programme->delete());
    }
}
