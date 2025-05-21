<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\Fees\LaboFeesSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaidLabosResource extends JsonResource
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
            'is_paid' => $this->is_paid,
            'labo_fees' => new LaboFeesSimpleResource($this->laboratoryFees),
            'created_at' => $this->created_at
        ];
    }
}
