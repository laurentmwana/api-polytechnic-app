<?php

namespace App\Http\Controllers\Other;

use App\Models\Programme;
use App\Http\Controllers\Controller;
use App\Http\Resources\Programme\ProgrammeResource;
use App\Http\Resources\Programme\ProgrammesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProgrammeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $programmes = Programme::with(['levels'])
            ->orderByDesc('updated_at')
            ->paginate();

        return ProgrammesResource::collection($programmes);
    }

    public function show(int $id): ProgrammeResource
    {
        $programme = Programme::with(['levels'])
            ->findOrFail($id);

        return new ProgrammeResource($programme);
    }
}
