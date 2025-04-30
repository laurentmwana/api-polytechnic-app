<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Eloquent\PaidLaboratoryEloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaidLaboratory extends Model
{
    protected $fillable = ['is_paid', 'student_id', 'laboratory_fees_id', 'paid_at'];

    public function newEloquentBuilder($query): PaidLaboratoryEloquent
    {
        return new PaidLaboratoryEloquent($query);
    }

    public function laboratoryFees(): BelongsTo
    {
        return $this->belongsTo(LaboratoryFees::class);
    }
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

}
