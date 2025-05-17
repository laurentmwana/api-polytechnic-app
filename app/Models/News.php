<?php

namespace App\Models;

use App\Eloquent\NewsEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory;

    public function newEloquentBuilder($query): NewsEloquent
    {
        return new NewsEloquent($query);
    }

    public function deliberation(): BelongsTo
    {
        return $this->BelongsTo(Deliberation::class);
    }
}
