<?php

namespace App\Http\Resources\Fees;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Level\LevelSimpleResource;
use App\Http\Resources\YearAcademic\YearAcademicSimpleResource;

class AcademicFeesSimpleResource extends JsonResource
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
            'amount' => $this->amount,
            'year' => new YearAcademicSimpleResource($this->yearAcademic),
            'level' => new LevelSimpleResource($this->level),
        ];
    }
}
