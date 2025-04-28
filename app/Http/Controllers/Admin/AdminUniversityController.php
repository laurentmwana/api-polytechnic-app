<?php

namespace App\Http\Controllers\Admin;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;
use App\Http\Resources\University\UniversityResource;
use App\Http\Resources\University\UniversitiesResource;
use App\Http\Resources\University\UniversitySimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminUniversityController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $universities = University::query()->findPaginated($request);

        return UniversitiesResource::collection($universities);
    }

    public function show(int $id): UniversityResource
    {
        $university = University::query()->findByIdOrThrow($id);

        return new UniversityResource($university);
    }

    public function update(UniversityRequest $request, int $id): UniversitySimpleResource
    {
        $university = University::findOrFail($id, ['id', 'name']);

        DB::transaction(function () use ($request, $university) {
            $university->update($request->validated());
        });

        return new UniversitySimpleResource($university);
    }
}
