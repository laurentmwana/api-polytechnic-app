<?php

namespace App\Http\Resources\Option;

use App\Http\Resources\Level\LevelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'levels' => new LevelResource($this->levels),
            'description' => $this->description,
            'department' => $this->department,
            'created_at' => $this->created_at
        ];;
    }
}
