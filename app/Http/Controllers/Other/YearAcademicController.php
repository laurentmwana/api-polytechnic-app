<?php

namespace App\Http\Controllers\Other;

use App\Models\YearAcademic;
use App\Http\Controllers\Controller;
use App\Http\Resources\YearAcademic\YearAcademicResource;
use App\Http\Resources\YearAcademic\YearAcademicsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class YearAcademicController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $years = YearAcademic::orderByDesc('updated_at')
            ->paginate();

        return YearAcademicsResource::collection($years);
    }

    public function show(int $id): YearAcademicResource
    {
        $year = YearAcademic::findOrFail($id);

        return new YearAcademicResource($year);
    }
}
