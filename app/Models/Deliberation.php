<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function level(): BelongsTo
    {
        return $this->BelongsTo(Level::class);
    }

    public function yearAcademic(): BelongsTo
    {
        return $this->BelongsTo(YearAcademic::class);
    }
}
