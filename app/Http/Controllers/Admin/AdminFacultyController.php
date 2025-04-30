<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyRequest;
use App\Http\Resources\Faculty\FacultyResource;
use App\Http\Resources\Faculty\FacultiesResource;
use App\Http\Resources\Faculty\FacultySimpleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminFacultyController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $faculties = Faculty::query()->findPaginated($request);

        return FacultiesResource::collection($faculties);
    }

    public function show(int $id): FacultyResource
    {
        $faculty = Faculty::query()->findByIdOrThrow($id);

        return new FacultyResource($faculty);
    }

    public function update(FacultyRequest $request, int $id): FacultySimpleResource
    {
        $faculty = Faculty::findOrFail($id);

        DB::transaction(function () use ($request, $faculty) {
            $faculty->update($request->validated());
        });

        return new FacultySimpleResource($faculty);
    }
}
