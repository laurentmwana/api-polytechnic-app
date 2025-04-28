<?php

namespace App\Models;

use App\Eloquent\LevelEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    /** @use HasFactory<\Database\Factories\LevelFactory> */
    use HasFactory;

    protected $fillable = ['option_id', 'programme_id'];

    public function newEloquentBuilder($query): LevelEloquent
    {
        return new LevelEloquent($query);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function programme(): BelongsTo
    {
        return $this->belongsTo(Programme::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
