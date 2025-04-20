<?php

namespace App\Http\Resources\University;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UniversitiesResource extends JsonResource
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
            'faculties' => $this->faculties->count('id'),
            'created_at' => $this->created_at
        ];
    }
}
