<?php

namespace App\Http\Resources\YearAcademic;

use Illuminate\Http\Request;
use App\Http\Resources\Level\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class YearAcademicResource extends JsonResource
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
            'created_at' => $this->created_at
        ];;
    }
}
