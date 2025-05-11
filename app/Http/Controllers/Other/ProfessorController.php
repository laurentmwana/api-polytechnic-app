<?php

namespace App\Http\Controllers\Other;

use App\Models\Professor;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Professor\ProfessorResource;
use App\Http\Resources\Professor\ProfessorsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProfessorController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $professors = Professor::query()->findSearchAndPaginated($request);

        return ProfessorsResource::collection($professors);
    }

    public function show(int $id): ProfessorResource
    {
        $professor = Professor::query()->findByIdThrow($id);

        return new ProfessorResource($professor);
    }
}
