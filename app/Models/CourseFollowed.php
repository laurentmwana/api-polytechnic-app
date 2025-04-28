<?php

namespace App\Models;

use App\Eloquent\CourseFollowedEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseFollowed extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFollowedFactory> */
    use HasFactory;

    public function newEloquentBuilder($query): CourseFollowedEloquent
    {
        return new CourseFollowedEloquent($query);
    }
}
