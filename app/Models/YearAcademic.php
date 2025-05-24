<?php

namespace App\Models;

use App\Eloquent\YearAcademicEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class YearAcademic extends Model
{
    /** @use HasFactory<\Database\Factories\YearAcademicFactory> */
    use HasFactory;

    public function newEloquentBuilder($query): YearAcademicEloquent
    {
        return new YearAcademicEloquent($query);
    }

    public function historicLevels(): HasMany
    {
        return $this->hasMany(HistoricLevel::class);
    }

    public function actualLevels(): HasMany
    {
        return $this->hasMany(ActualLevel::class);
    }
}
