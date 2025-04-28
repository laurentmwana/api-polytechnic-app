<?php

namespace App\Http\Resources\Faculty;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultySimpleResource extends JsonResource
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
        ];
    }
}
