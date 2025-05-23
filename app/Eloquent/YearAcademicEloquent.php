<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use App\Eloquent\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class YearAcademicEloquent extends Builder
{

    private const SEARCH_COLUMNS = ['start', 'end', 'is_closed'];

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

    public function pending()
    {
        return $this->getQueryRelation()
            ->where('is_closed', '=', false)->first();
    }

    private function getQueryRelation()
    {
        return $this->with(['actualLevels']);
    }
}
