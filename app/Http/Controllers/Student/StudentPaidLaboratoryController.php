<?php

namespace App\Http\Controllers\Student;

use App\Models\PaidLaboratory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaidLaboResource;
use App\Http\Resources\Payment\PaidLabosResource;

class StudentPaidLaboratoryController extends Controller
{
    public function index()
    {
        $paidLabos = PaidLaboratory::query()
            ->findPaginated();

        return PaidLabosResource::collection($paidLabos);
    }
    public function show(int $id)
    {
        $paidLabo = PaidLaboratory::query()
            ->findByIdOrThrow($id);

        return new PaidLaboResource($paidLabo);
    }
}
