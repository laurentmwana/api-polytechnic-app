<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PaidAcademicEloquent extends Builder
{
    public function findPaginated()
    {
        return  $this->getQueryToRelation()->paginate();
    }

    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryToRelation()
            ->findOrFail($id);
    }

    private function getQueryToRelation()
    {
        $userId = Auth::user()->id;

        return $this->with([
            'academicFees',
            'academicFees.level',
            'academicFees.yearAcademic',
            'student'
        ])
            ->whereHas('student', function ($query) use ($userId) {
                $query->where('user_id', '=', $userId);
            });
    }
}
