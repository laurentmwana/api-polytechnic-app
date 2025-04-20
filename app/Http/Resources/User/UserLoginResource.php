<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->tokens()->delete();

        $plainTextToken = $this->createToken($this->email)->plainTextToken;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $plainTextToken,
            'roles' => $this->roles,
            'permissions' => $this->permissions,
        ];
    }
}
