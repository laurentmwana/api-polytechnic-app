<?php

namespace App\Models;

use App\Eloquent\AcademicFeesEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicFees extends Model
{
    /** @use HasFactory<\Database\Factories\AcademicFeesFactory> */
    use HasFactory;

    protected $fillable = ['amount', 'year_academic_id', 'level_id'];

    public function newEloquentBuilder($query): AcademicFeesEloquent
    {
        return new AcademicFeesEloquent($query);
    }

    public function yearAcademic(): BelongsTo
    {
        return $this->belongsTo(YearAcademic::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
}
