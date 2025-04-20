<?php

namespace App\Http\Controllers\Other;

use App\Models\Faculty;
use App\Http\Controllers\Controller;
use App\Http\Resources\Faculty\FacultyResource;
use App\Http\Resources\Faculty\FacultiesResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FacultyController extends Controller
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
}
