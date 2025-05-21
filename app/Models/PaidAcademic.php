<?php

namespace App\Models;

use App\Repositories\PaidAcademicEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaidAcademic extends Model
{
    protected $fillable = ['is_paid', 'student_id', 'laboratory_fees_id', 'paid_at'];

    public function newEloquentBuilder($query): PaidAcademicEloquent
    {
        return new PaidAcademicEloquent($query);
    }

    public function academicFees(): BelongsTo
    {
        return $this->belongsTo(AcademicFees::class);
    }


    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
