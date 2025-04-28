<?php

namespace App\Models;

use App\Eloquent\PaidAcademicEloquent;
use Illuminate\Database\Eloquent\Model;

class PaidAcademic extends Model
{

    public function newEloquentBuilder($query): PaidAcademicEloquent
    {
        return new PaidAcademicEloquent($query);
    }
}
