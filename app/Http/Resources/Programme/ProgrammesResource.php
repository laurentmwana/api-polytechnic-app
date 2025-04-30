<?php

namespace App\Http\Resources\Programme;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Faculty\FacultySimpleResource;

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
            'alias' => $this->alias,
            'programme_group' => $this->programme_group,
            'levels' => $this->levels->count('id'),
            'created_at' => $this->created_at,
        ];
    }
}
