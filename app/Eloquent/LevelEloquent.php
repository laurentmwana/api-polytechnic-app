<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use App\Eloquent\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class LevelEloquent extends Builder
{

    private const SEARCH_COLUMNS = ['programme_id', 'option_id'];

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
        return $this->with(['programme', 'option']);
    }
}
