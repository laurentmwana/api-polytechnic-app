<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\DeliberationEloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliberation extends Model
{
    /** @use HasFactory<\Database\Factories\DeliberationFactory> */
    use HasFactory;

    protected $fillable = [
        'level_id',
        'year_academic_id',
        'start_at',
    ];

    public function newEloquentBuilder($query): DeliberationEloquent
    {
        return new DeliberationEloquent($query);
    }

    public function level(): BelongsTo
    {
        return $this->BelongsTo(Level::class);
    }

    public function yearAcademic(): BelongsTo
    {
        return $this->BelongsTo(YearAcademic::class);
    }
}
