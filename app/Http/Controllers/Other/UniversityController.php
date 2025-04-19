<?php

namespace App\Http\Controllers\Other;

use App\Models\University;
use App\Http\Controllers\Controller;
use App\Http\Resources\University\UniversityResource;
use App\Http\Resources\University\UniversitiesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UniversityController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $universities = University::with(['faculties'])
            ->orderByDesc('updated_at')
            ->paginate();

        return UniversitiesResource::collection($universities);
    }

    public function show(int $id): UniversityResource
    {
        $university = University::with(['faculties'])
            ->findOrFail($id);

        return new UniversityResource($university);
    }
}
