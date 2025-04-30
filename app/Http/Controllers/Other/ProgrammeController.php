<?php

namespace App\Http\Controllers\Other;

use App\Models\Programme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Programme\ProgrammeResource;
use App\Http\Resources\Programme\ProgrammesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProgrammeController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $programmes = Programme::query()->findSearchAndPaginated($request);

        return ProgrammesResource::collection($programmes);
    }

    public function show(int $id): ProgrammeResource
    {
        $programme = Programme::query()->findByIdThrow($id);

        return new ProgrammeResource($programme);
    }
}
