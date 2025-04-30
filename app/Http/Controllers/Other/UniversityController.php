<?php

namespace App\Http\Controllers\Other;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\University\UniversityResource;
use App\Http\Resources\University\UniversitiesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UniversityController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $universities = University::query()->findPaginated($request);

        return UniversitiesResource::collection($universities);
    }

    public function show(int $id): UniversityResource
    {
        $university = University::findByIdOrThrow($id);

        return new UniversityResource($university);
    }
}
