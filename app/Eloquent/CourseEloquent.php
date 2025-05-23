<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use App\Eloquent\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class CourseEloquent extends Builder
{
    private const SEARCH_COLUMNS = ['name', 'credits', 'level_id', 'professor_id'];

    public function findSearchAndPaginated(Request $request)
    {
        $searchValue = $request->query('search');

        $builder = $this->getQueryRelation();

        return SearchDataEloquent::handle(
            $builder,
            $searchValue,
            self::SEARCH_COLUMNS
        )->paginate();
    }

    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryRelation()->findOrFail($id);
    }

    public function findById(string $id)
    {
        return $this->getQueryRelation()->find($id);
    }

    private function getQueryRelation(): CourseEloquent
    {
        return $this->with(['level', 'professor']);
    }
}
