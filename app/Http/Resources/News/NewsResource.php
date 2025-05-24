<?php

namespace App\Http\Resources\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSecondarySimpleResource;
use App\Http\Resources\Deliberation\DeliberationSimpleResource;

class NewsResource extends JsonResource
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
            'title' => $this->title,
            'message' => $this->message,
            'deliberation' => new DeliberationSimpleResource($this->deliberation),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
