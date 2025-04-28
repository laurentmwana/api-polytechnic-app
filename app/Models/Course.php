<?php

namespace App\Models;

use App\Eloquent\CourseEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'credits',
        'level_id',
        'semester',
        'professor_id',
    ];

    public function newEloquentBuilder($query): CourseEloquent
    {
        return new CourseEloquent($query);
    }


    public function professor(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
