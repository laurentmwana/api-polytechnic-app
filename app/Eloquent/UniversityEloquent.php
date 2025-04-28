<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Builder;

class UniversityEloquent extends Builder {
    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryRelation()->findOrFail($id);
    }

    public function findById(string $id)
    {
        return $this->getQueryRelation()->find($id);
    }

    public function findPaginated()
    {
        return $this->getQueryRelation()->orderByDesc('updated_at')->paginate();
    }

    private function getQueryRelation()
    {
        return $this->with(['faculties']);
    }
}
