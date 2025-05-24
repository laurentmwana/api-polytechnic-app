<?php

namespace App\Http\Resources\Notification;

use App\Http\Resources\Level\LevelSimpleResource;
use App\Http\Resources\YearAcademic\YearAcademicSimpleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
        ];
    }
}
