<?php

namespace App\Models;

use App\Repositories\LaboratoryFeesEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaboratoryFees extends Model
{
    /** @use HasFactory<\Database\Factories\LaboratoryFeesFactory> */
    use HasFactory;

    public function newEloquentBuilder($query): LaboratoryFeesEloquent
    {
        return new LaboratoryFeesEloquent($query);
    }

    public function yearAcademic(): BelongsTo
    {
        return $this->belongsTo(YearAcademic::class);
    }
}
