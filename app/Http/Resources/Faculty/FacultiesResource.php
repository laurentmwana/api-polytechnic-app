<?php

namespace App\Http\Resources\Faculty;

use App\Http\Resources\University\UniversityUpdateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultiesResource extends JsonResource
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
            'departments' => $this->departments->count('id'),
            'university' => new UniversityUpdateResource($this->university),
            'created_at' => $this->created_at
        ];
    }
}
