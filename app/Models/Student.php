<?php

namespace App\Models;

use App\Repositories\StudentEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'gender',
        'number_phone',
        'registration_token',
        'birth',
        'user_id'
    ];

    public function newEloquentBuilder($query): StudentEloquent
    {
        return new StudentEloquent($query);
    }

    public function actualLevel(): HasOne
    {
        return $this->hasOne(ActualLevel::class);
    }

    public function historicLevels(): HasMany
    {
        return $this->hasMany(HistoricLevel::class);
    }
}
