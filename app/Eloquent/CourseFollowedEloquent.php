<?php

namespace App\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CourseFollowedEloquent extends Builder
{
    private const SEARCH_COLUMNS = ['year_academic_id', 'course_id'];

    public function findSearchAndPaginated(Request $request)
    {
        $user = $request->user();

        $searchValue = $request->query('search');

        $builder = $this->getQueryToRelation($user->id);

        return SearchDataEloquent::handle(
            $builder,
            $searchValue,
            self::SEARCH_COLUMNS
        )->paginate();
    }

    public function findByIdOrThrow(int $userId, string $id)
    {
        return $this->getQueryToRelation($userId)->findOrFail($id);
    }

    private function getQueryToRelation(int $userId)
    {
        return $this->with([
            'course',
            'yearAcademic',
            'course.professor',
            'course.level'
        ])
            ->whereHas('student', function ($query) use ($userId) {
                $query->where('user_id', '=', $userId);
            });
    }
}
