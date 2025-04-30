<?php

namespace App\Http\Resources\Level;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Option\OptionSimpleResource;
use App\Http\Resources\Programme\ProgrammeSimpleResource;

class LevelsResource extends JsonResource
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
            'option' =>  new OptionSimpleResource($this->option),
            'programme' =>  new ProgrammeSimpleResource($this->programme),
            'created_at' => $this->created_at
        ];
    }
}
