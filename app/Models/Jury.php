<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Jury extends Model
{
    /** @use HasFactory<\Database\Factories\JuryFactory> */
    use HasFactory;

    protected $fillable = ['level_id', 'year_academic_id'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function yearAcademic(): BelongsTo
    {
        return $this->belongsTo(YearAcademic::class);
    }

        public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class);
    }
}
