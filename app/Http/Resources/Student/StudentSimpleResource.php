<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSecondarySimpleResource;

class StudentSimpleResource extends JsonResource
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
            'registration_token' => $this->registration_token,
            'gender' => $this->gender,
            'actual_level' => (new LevelSecondarySimpleResource($this->actualLevel)),
        ];
    }
}
