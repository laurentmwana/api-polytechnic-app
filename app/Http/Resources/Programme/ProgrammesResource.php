<?php

namespace App\Http\Resources\Programme;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Faculty\FacultyUpdateResource;

class ProgrammesResource extends JsonResource
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
            'faculty' =>  new FacultyUpdateResource($this->faculty),
            'created_at' => $this->created_at
        ];
    }
}
