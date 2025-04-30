<?php

namespace App\Http\Resources\Faculty;

use App\Http\Resources\University\UniversitySimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Department\DepartmentSimpleResource;

class FacultyResource extends JsonResource
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
            'university' => (new UniversitySimpleResource($this->university)),
            'departments' => DepartmentSimpleResource::collection($this->departments),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
