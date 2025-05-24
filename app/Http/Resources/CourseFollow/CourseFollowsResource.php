<?php

namespace App\Http\Resources\CourseFollow;

use App\Http\Resources\Course\CourseSimpleLevelResource;
use App\Http\Resources\YearAcademic\YearAcademicSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseFollowsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'year' => new YearAcademicSimpleResource($this->yearAcademic),
            'course' => new CourseSimpleLevelResource($this->course),
            'created_at' => $this->created_at
        ];
    }
}
