<?php

namespace App\Http\Controllers\Admin;

use App\Models\Level;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Http\Resources\Level\LevelsResource;
use App\Http\Resources\Level\LevelResource;
use App\Http\Resources\Level\LevelUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminLevelController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $levels = Level::with(['programme', 'option'])
            ->orderByDesc('updated_at')
            ->paginate();

        return LevelsResource::collection($levels);
    }

    public function store(LevelRequest $request): LevelUpdateResource
    {
        $level = DB::transaction(function () use ($request) {
            return Level::create($request->validated());
        });

        return new LevelUpdateResource($level);
    }

    public function show(int $id): LevelResource
    {
        $level = Level::with(['programme', ''])
            ->findOrFail($id);

        return new LevelResource($level);
    }

    public function update(LevelRequest $request, int $id): LevelUpdateResource
    {
        $department = Level::findOrFail($id, ['name', 'id']);

        DB::transaction(function () use ($request, $department) {
            $department->update($request->validated());
        });

        return new LevelUpdateResource($department);
    }


    public function destroy(int $id): bool|null
    {
        $department = Level::findOrFail($id);

        return DB::transaction(fn(): bool|null => $department->delete());
    }
}
