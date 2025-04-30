<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Faculty\FacultySimpleResource;
use App\Http\Resources\Level\LevelSecondarySimpleResource;

class StudentsResource extends JsonResource
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
            'firstname' => $this->firstname,
            'gender' => $this->gender,
            'actual_level' => new LevelSecondarySimpleResource($this->actualLevel),
            'created_at' => $this->created_at
        ];
    }
}
