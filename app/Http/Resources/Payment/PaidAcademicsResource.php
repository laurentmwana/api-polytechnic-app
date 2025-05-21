<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\Fees\AcademicFeesSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaidAcademicsResource extends JsonResource
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
            'academic_fees' => new AcademicFeesSimpleResource($this->academicFees),
            'created_at' => $this->created_at
        ];
    }
}
