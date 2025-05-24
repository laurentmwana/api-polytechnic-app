<?php

namespace App\Http\Resources\Deliberation;

use App\Http\Resources\Level\LevelSimpleResource;
use App\Http\Resources\YearAcademic\YearAcademicSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliberationResource extends JsonResource
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
            'level' => new LevelSimpleResource($this->level),
            'year' => new YearAcademicSimpleResource($this->yearAcademic),
            'start_at' => $this->start_at,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
