<?php

namespace App\Http\Resources\Option;

use App\Http\Resources\Department\DepartmentUpdateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Faculty\FacultyUpdateResource;

class OptionsResource extends JsonResource
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
            'alias' => $this->alias,
            'levels' => $this->levels->count('id'),
            'department' =>  new DepartmentUpdateResource($this->department),
            'created_at' => $this->created_at
        ];
    }
}
