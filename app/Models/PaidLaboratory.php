<?php

namespace App\Models;

use App\Eloquent\PaidLaboratoryEloquent;
use Illuminate\Database\Eloquent\Model;

class PaidLaboratory extends Model
{

    public function newEloquentBuilder($query): PaidLaboratoryEloquent
    {
        return new PaidLaboratoryEloquent($query);
    }
}
