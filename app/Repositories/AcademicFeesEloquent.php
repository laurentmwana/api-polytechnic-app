<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

class AcademicFeesEloquent extends Builder
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
        return $this->with([
            'yearAcademic',
            'level',
        ]);
    }
}
