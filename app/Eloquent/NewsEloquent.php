<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use App\Eloquent\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class NewsEloquent extends Builder
{
    private const SEARCH_COLUMNS = ['title', 'message', 'department_id', 'start_at'];

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
    public function findLimit(int $limit)
    {
        return $this->getQueryRelation()
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get();
    }


    private function getQueryRelation()
    {
        return $this->with(['deliberation']);
    }
}
