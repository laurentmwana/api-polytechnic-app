<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use App\Eloquent\SearchDataEloquent;
use Illuminate\Database\Eloquent\Builder;

class DepartmentEloquent extends Builder
{
    private const SEARCH_COLUMNS = ['faculty_id', 'name', 'description'];

    public function findSearchAndPaginated(Request $request)
    {
        $searchValue = $request->query('search');

        $builder = $this->getQueryRelation();

        return SearchDataEloquent::handle(
            $builder,
            $searchValue,
            self::SEARCH_COLUMNS
        )->paginate(2);
    }
    public function findLimit(int $limit)
    {
        return $this->getQueryRelation()
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get();
    }

    public function findByIdOrThrow(string $id)
    {
        return $this->getQueryRelation()->findOrFail($id);
    }

    public function findById(string $id)
    {
        return $this->getQueryRelation()->find($id);
    }


    private function getQueryRelation(): DepartmentEloquent
    {
        return $this->with(['faculty', 'options']);
    }
}
