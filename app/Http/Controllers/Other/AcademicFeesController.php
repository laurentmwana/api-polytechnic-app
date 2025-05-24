<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Http\Resources\Fees\AcademicFeesSimpleResource;
use App\Models\AcademicFees;

class AcademicFeesController extends Controller
{
    public function index()
    {
        $academics = AcademicFees::query()
            ->findPaginated();

        return AcademicFeesSimpleResource::collection($academics);
    }
    public function show(int $id)
    {
        $academic = AcademicFees::query()
            ->findByIdOrThrow($id);

        return new AcademicFeesSimpleResource($academic);
    }
}
