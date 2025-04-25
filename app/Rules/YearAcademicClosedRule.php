<?php

namespace App\Rules;

use App\Models\YearAcademic;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class YearAcademicClosedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $year = YearAcademic::where('closed', '=', true)
            ->where('id', '=', $value)
            ->first();

        if ($year instanceof YearAcademic) {
            $fail("Vous ne pouvez pas être dans une année académique qui est cloturé");
        }
    }
}
