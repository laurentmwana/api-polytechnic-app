<?php

namespace App\Http\Controllers\Admin;

use App\Models\University;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;
use App\Http\Resources\University\UniversityResource;
use App\Http\Resources\University\UniversitiesResource;
use App\Http\Resources\University\UniversityUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminUniversityController extends Controller
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
    public function update(UniversityRequest $request, int $id): UniversityUpdateResource
    {
        $university = University::findOrFail($id, ['id', 'name']);

        DB::transaction(function () use ($request, $university) {
            $university->update($request->validated());
        });

        return new UniversityUpdateResource($university);
    }
}
