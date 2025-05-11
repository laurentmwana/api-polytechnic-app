<?php

namespace App\Http\Resources\Department;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Faculty\FacultySimpleResource;
use App\Http\Resources\Option\OptionSimpleResource;

class DepartmentsResource extends JsonResource
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
            'description' => $this->description,
            'options' => OptionSimpleResource::collection($this->options),
            'faculty' =>  new FacultySimpleResource($this->faculty),
            'created_at' => $this->created_at
        ];
    }
}
