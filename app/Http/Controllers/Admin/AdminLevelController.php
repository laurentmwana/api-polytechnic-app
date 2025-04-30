<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LevelRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Level\LevelResource;
use App\Http\Resources\Level\LevelsResource;
use App\Http\Resources\Level\LevelSimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminLevelController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $levels = Level::query()->findSearchAndPaginated($request);

        return LevelsResource::collection($levels);
    }

    public function store(LevelRequest $request): LevelSimpleResource
    {
        $level = DB::transaction(function () use ($request) {
            return Level::create($request->validated());
        });

        return new LevelSimpleResource($level);
    }

    public function show(int $id): LevelResource
    {
        $level = Level::query()->findByIdOrThrow($id);

        return new LevelResource($level);
    }

    public function update(LevelRequest $request, int $id): LevelSimpleResource
    {
        $department = Level::findOrFail($id);

        DB::transaction(function () use ($request, $department) {
            $department->update($request->validated());
        });

        return new LevelSimpleResource($department);
    }


    public function destroy(int $id): bool|null
    {
        $department = Level::findOrFail($id);

        return DB::transaction(fn(): bool|null => $department->delete());
    }
}
