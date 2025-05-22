<?php

namespace App\Http\Resources\Professor;

use App\Http\Resources\Department\DepartmentSimpleResource;
use Illuminate\Http\Request;
use App\Helpers\ImageUrlDomain;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessorLeaderResource extends JsonResource
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
            'firstname' => $this->firstname,
            'gender' => $this->gender,
            'birth' => $this->birth,
            'department' => new DepartmentSimpleResource($this->department),
        ];
    }
}
