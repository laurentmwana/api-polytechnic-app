<?php

namespace App\Http\Resources\Programme;

use Illuminate\Http\Request;
use App\Http\Resources\Level\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSimpleResource;

class ProgrammeResource extends JsonResource
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
            'programme_group' => $this->programme_group,
            'levels' => LevelSimpleResource::collection($this->levels),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
