<?php

namespace App\Models;

use App\Eloquent\UniversityEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    /** @use HasFactory<\Database\Factories\UniversityFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function newEloquentBuilder($query): UniversityEloquent
    {
        return new UniversityEloquent($query);
    }

    public function faculties(): HasMany
    {
        return $this->hasMany(Faculty::class);
    }
}
