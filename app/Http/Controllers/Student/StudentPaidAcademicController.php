<?php

namespace App\Http\Controllers\Student;

use App\Models\PaidAcademic;
use App\Http\Controllers\Controller;
use App\Http\Resources\Payment\PaidAcademicResource;
use App\Http\Resources\Payment\PaidAcademicsResource;

class StudentPaidAcademicController extends Controller
{
    public function index()
    {
        $paidAcademics = PaidAcademic::query()
            ->findPaginated();

        return PaidAcademicsResource::collection($paidAcademics);
    }
    public function show(int $id)
    {
        $paidAcademic = PaidAcademic::query()
            ->findByIdOrThrow($id);

        return new PaidAcademicResource($paidAcademic);
    }
}
