<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Http\Resources\Fees\LaboFeesSimpleResource;
use App\Models\LaboratoryFees;

class LaboratoryFeesController extends Controller
{
    public function index()
    {
        $laboratories = LaboratoryFees::query()
            ->findPaginated();

        return LaboFeesSimpleResource::collection($laboratories);
    }
    public function show(int $id)
    {
        $laboratory = LaboratoryFees::query()
            ->findByIdOrThrow($id);

        return new LaboFeesSimpleResource($laboratory);
    }
}
