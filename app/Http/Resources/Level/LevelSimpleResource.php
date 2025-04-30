<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Option\OptionSimpleResource;
use App\Http\Resources\Programme\ProgrammeSimpleResource;

class LevelSimpleResource extends JsonResource
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
            'programme' => new ProgrammeSimpleResource($this->programme),
            'option' =>  new OptionSimpleResource($this->option),
        ];
    }
}
