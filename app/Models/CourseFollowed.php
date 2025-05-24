<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\CourseFollowedEloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseFollowed extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFollowedFactory> */
    use HasFactory;

    public function newEloquentBuilder($query): CourseFollowedEloquent
    {
        return new CourseFollowedEloquent($query);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function yearAcademic(): BelongsTo
    {
        return $this->belongsTo(YearAcademic::class);
    }
}
