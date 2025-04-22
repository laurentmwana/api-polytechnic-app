<?php

namespace App\Models;

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
        'lastname',
        'gender',
        'birth',
    ];

    public function actualLevel(): HasOne
    {
        return $this->hasOne(ActualLevel::class);
    }

    public function historicLevels(): HasMany
    {
        return $this->hasMany(HistoricLevel::class);
    }
}
