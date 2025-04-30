<?php

namespace App\Eloquent;

use App\Eloquent\SearchDataEloquent;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FacultyEloquent extends Builder
{
    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryRelation()->findOrFail($id);
    }
    public function findById(string $id)
    {
        return $this->getQueryRelation()->find($id);
    }

    public function findSPaginated()
    {
        return $this->getQueryRelation()->orderByDesc('updated_at')->paginate();
    }

    private function getQueryRelation()
    {
        return $this->with(['university', 'departments']);
    }
}
