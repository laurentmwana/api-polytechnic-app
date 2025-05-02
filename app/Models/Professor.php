<?php

namespace App\Models;

use App\Eloquent\ProfessorEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model
{
    /** @use HasFactory<\Database\Factories\ProfessorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'gender',
        'number_phone',
        'department_id',
        'grade',
        'image'
    ];

    public function newEloquentBuilder($query): ProfessorEloquent
    {
        return new ProfessorEloquent($query);
    }
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
