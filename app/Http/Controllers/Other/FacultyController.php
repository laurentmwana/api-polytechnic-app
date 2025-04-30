<?php

namespace App\Http\Controllers\Other;

use App\Models\Faculty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Faculty\FacultyResource;
use App\Http\Resources\Faculty\FacultiesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FacultyController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $faculties = Faculty::query()->findPaginated($request);

        return FacultiesResource::collection($faculties);
    }

    public function show(int $id): FacultyResource
    {
        $faculty = Faculty::query()->findByIdThrow($id);

        return new FacultyResource($faculty);
    }
}
