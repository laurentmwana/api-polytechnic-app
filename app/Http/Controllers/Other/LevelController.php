<?php

namespace App\Http\Controllers\Other;

use App\Models\Level;
use App\Http\Controllers\Controller;
use App\Http\Resources\Level\LevelsResource;
use App\Http\Resources\Level\LevelResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LevelController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $levels = Level::with(['programme', 'option'])
            ->orderByDesc('updated_at')
            ->paginate();

        return LevelsResource::collection($levels);
    }

    public function show(int $id): LevelResource
    {
        $level = Level::with(['programme', ''])
            ->findOrFail($id);

        return new LevelResource($level);
    }
}
