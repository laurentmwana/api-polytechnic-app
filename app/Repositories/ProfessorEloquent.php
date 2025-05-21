<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class ProfessorEloquent extends Builder
{

    private const SEARCH_COLUMNS = ['name', 'firstname', 'gender', 'number_phone'];


    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryRelation()->findOrFail($id);
    }

    public function findById(string $id)
    {
        return $this->getQueryRelation()->find($id);
    }

    public function findSearchAndPaginated(Request $request)
    {
        $queryValue = $request->get('search');

        $builder =  $this->getQueryRelation()->orderByDesc('updated_at');

        return SearchDataEloquent::handle(
            $builder,
            $queryValue,
            self::SEARCH_COLUMNS
        )->paginate();
    }

    private function getQueryRelation()
    {
        return $this->with(['courses', 'department']);
    }
}
