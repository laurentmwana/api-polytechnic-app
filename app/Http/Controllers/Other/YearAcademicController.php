<?php

namespace App\Http\Controllers\Other;

use App\Models\YearAcademic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\YearAcademic\YearAcademicResource;
use App\Http\Resources\YearAcademic\YearAcademicsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class YearAcademicController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $years = YearAcademic::query()->findSearchAndPaginated($request);

        return YearAcademicsResource::collection($years);
    }

    public function show(int $id): YearAcademicResource
    {
        $year = YearAcademic::findOrFail($id);

        return new YearAcademicResource($year);
    }
}
