<?php

namespace App\Http\Resources\Professor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Course\CourseSimpleLevelResource;
use App\Http\Resources\Department\DepartmentSimpleResource;

class ProfessorResource extends JsonResource
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
            'name' => $this->name,
            'firstname' => $this->firstname,
            'gender' => $this->gender,
            'number_phone' => $this->number_phone,
            'department' =>  new DepartmentSimpleResource($this->department),
            'courses' => CourseSimpleLevelResource::collection($this->courses),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
