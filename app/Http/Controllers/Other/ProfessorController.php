<?php

namespace App\Http\Controllers\Other;

use App\Models\Professor;
use App\Models\Programme;
use Illuminate\Http\Request;
use App\Enums\GradeProfessorEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Professor\ProfessorResource;
use App\Http\Resources\Programme\ProgrammeResource;
use App\Http\Resources\Professor\ProfessorsResource;
use App\Http\Resources\Programme\ProgrammesResource;
use App\Http\Resources\Professor\ProfessorLeaderResource;
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

    public function leader(): AnonymousResourceCollection
    {
        $professors = Professor::query()
            ->with(['department'])
            ->limit(10)
            ->whereIn('grade', [
                GradeProfessorEnum::DEAN->value,
                GradeProfessorEnum::VICE_DEAN->value,
                GradeProfessorEnum::LAB_DIRECTOR->value,
                GradeProfessorEnum::HEAD_OF_DEPARTMENT->value,
            ])->get();

        return ProfessorLeaderResource::collection($professors);
    }
}
