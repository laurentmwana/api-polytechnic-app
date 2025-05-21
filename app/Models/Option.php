<?php

namespace App\Models;

use App\Repositories\OptionEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    /** @use HasFactory<\Database\Factories\OptionFactory> */
    use HasFactory;
    protected $fillable = ['name', 'alias', 'descriptions', 'department_id'];

    public function newEloquentBuilder($query): OptionEloquent
    {
        return new OptionEloquent($query);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }
}
