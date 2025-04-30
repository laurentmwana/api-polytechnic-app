<?php

namespace App\Http\Resources\Student;

use App\Http\Resources\Level\LevelSecondarySimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'lastname' => $this->lastname,
            'number_phone' => $this->number_phone,
            'registration_token' => $this->registration_token,
            'gender' => $this->gender,
            'actual_level' => (new LevelSecondarySimpleResource($this->actualLevel)),
            'historic_levels' => LevelSecondarySimpleResource::collection($this->historicLevels),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
