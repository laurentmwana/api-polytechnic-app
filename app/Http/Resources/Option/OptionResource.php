<?php

namespace App\Http\Resources\Option;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSimpleOptionResource;
use App\Http\Resources\Department\DepartmentSimpleResource;

class OptionResource extends JsonResource
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
            'levels' => LevelSimpleOptionResource::collection($this->levels),
            'department' => new DepartmentSimpleResource($this->department),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
