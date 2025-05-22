<?php

namespace App\Http\Resources\Professor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Course\CourseSimpleResource;
use App\Http\Resources\Faculty\FacultySimpleResource;
use App\Http\Resources\Department\DepartmentSimpleResource;

class ProfessorsResource extends JsonResource
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
            'department' =>  new DepartmentSimpleResource($this->department),
            'courses' => CourseSimpleResource::collection($this->courses),
            'created_at' => $this->created_at
        ];
    }
}
