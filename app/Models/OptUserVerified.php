<?php

namespace App\Models;

use App\Repositories\OptUserEloquent;
use Illuminate\Database\Eloquent\Model;

class OptUserVerified extends Model
{
    protected $fillable = ['user_id', 'opt', 'expirate'];
    public function newEloquentBuilder($query): OptUserEloquent
    {
        return new OptUserEloquent($query);
    }
}
