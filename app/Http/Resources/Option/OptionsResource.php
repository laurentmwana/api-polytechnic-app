<?php

namespace App\Http\Resources\Option;

use App\Http\Resources\Department\DepartmentSimpleResource;
use App\Http\Resources\Level\LevelSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'alias' => $this->alias,
            'levels' => LevelSimpleResource::collection($this->levels),
            'department' =>  new DepartmentSimpleResource($this->department),
            'created_at' => $this->created_at
        ];
    }
}
