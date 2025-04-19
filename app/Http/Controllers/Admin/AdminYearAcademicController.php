<?php

namespace App\Http\Controllers\Admin;

use App\Models\YearAcademic;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exceptions\YearAcademicIsActiveException;
use App\Http\Resources\YearAcademic\YearAcademicResource;
use App\Http\Resources\YearAcademic\YearAcademicsResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminYearAcademicController extends Controller
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
    public function update(int $id): YearAcademicResource
    {
        $year = YearAcademic::findOrFail($id);

        if ($year->is_closed) {
            throw new YearAcademicIsActiveException(
                "L'année académique {$year->name} est déjà cloturée, vous ne pouvez pas la faire deux fois (:"
            );
        }

        $start = $year->end;
        $end = $start + 1;

        $newYear = DB::transaction(function () use ($start, $end, $year) {
            $newYear = YearAcademic::create([
                'start' => $start,
                'end' => $end,
            ]);

            $year->update(['is_closed' => true]);

            return $newYear;
        });

        return new YearAcademicResource($newYear);
    }
}
