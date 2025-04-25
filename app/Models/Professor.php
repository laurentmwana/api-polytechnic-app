<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professor extends Model
{
    /** @use HasFactory<\Database\Factories\ProfessorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'firstname',
        'lastname',
        'gender',
        'phone',
        'birth',
    ];



    // public function courses(): HasMany
    // {
    //     return $this->hasMany(HistoricLevel::class);
    // }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
