<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Level\UtilResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMeResource extends JsonResource
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
            'email' => $this->email,
            'roles' => UtilResource::collection($this->roles),
            'permissions' => UtilResource::collection($this->permissions),
        ];
    }
}
