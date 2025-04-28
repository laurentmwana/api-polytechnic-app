<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Option\OptionSimpleResource;
use App\Http\Resources\Faculty\FacultySimpleResource;

class DepartmentResource extends JsonResource
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
            'faculty' => new FacultySimpleResource($this->faculty),
            'options' => OptionSimpleResource::collection($this->options),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
