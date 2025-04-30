<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSimpleResource;
use App\Http\Resources\Student\StudentSimpleResource;
use App\Http\Resources\YearAcademic\YearAcademicSimpleResource;

class LevelSecondaryResource extends JsonResource
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
            'year_academic' => new YearAcademicSimpleResource($this->yearAcademic),
            'student' => new StudentSimpleResource($this->student),
        ];
    }
}
