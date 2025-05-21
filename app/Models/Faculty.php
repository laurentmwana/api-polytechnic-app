<?php

namespace App\Models;

use App\Repositories\FacultyEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    /** @use HasFactory<\Database\Factories\FacultyFactory> */
    use HasFactory;

    protected $fillable = ['name', 'university_id', 'description'];
    public function newEloquentBuilder($query): FacultyEloquent
    {
        return new FacultyEloquent($query);
    }

    public function university(): BelongsTo
    {
        return $this->BelongsTo(University::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
