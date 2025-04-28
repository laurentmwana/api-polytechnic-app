<?php

namespace App\Models;

use App\Eloquent\ProgrammeEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    /** @use HasFactory<\Database\Factories\ProgrammeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'alias', 'programe_group'];

    public function newEloquentBuilder($query): ProgrammeEloquent
    {
        return new ProgrammeEloquent($query);
    }

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }
}
