<?php

namespace App\Http\Controllers\Other;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Level\LevelResource;
use App\Http\Resources\Level\LevelsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LevelController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $levels = Level::query()->findSearchAndPaginated($request);

        return LevelsResource::collection($levels);
    }

    public function show(int $id): LevelResource
    {
        $level = Level::query()->findByIdOrThrow($id);

        return new LevelResource($level);
    }
}
