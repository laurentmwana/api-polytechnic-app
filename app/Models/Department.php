<?php

namespace App\Models;

use App\Repositories\DepartmentEloquent;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    protected $fillable = ['name', 'faculty_id', 'description'];


    public function newEloquentBuilder($query): DepartmentEloquent
    {
        return new DepartmentEloquent($query);
    }

    public function faculty(): BelongsTo
    {
        return $this->BelongsTo(Faculty::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }
}
