<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faculty;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyRequest;
use App\Http\Resources\Faculty\FacultyResource;
use App\Http\Resources\Faculty\FacultiesResource;
use App\Http\Resources\Faculty\FacultyUpdateResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminFacultyController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $faculties = Faculty::with(['departments'])
            ->orderByDesc('updated_at')
            ->paginate();

        return FacultiesResource::collection($faculties);
    }

    public function show(int $id): FacultyResource
    {
        $faculty = Faculty::with(['university', 'departments'])->findOrFail($id);

        return new FacultyResource($faculty);
    }

    public function update(FacultyRequest $request, int $id): FacultyUpdateResource
    {
        $faculty = Faculty::findOrFail($id);

        DB::transaction(function () use ($request, $faculty) {
            $faculty->update($request->validated());
        });

        return new FacultyUpdateResource($faculty);
    }
}
