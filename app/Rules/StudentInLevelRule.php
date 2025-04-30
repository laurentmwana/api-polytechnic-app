<?php

namespace App\Rules;

use App\Models\ActualLevel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StudentInLevelRule implements ValidationRule
{
    public function __construct(private ?string $yearId, private ?string $studentId) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $_, mixed $value, Closure $fail): void
    {
        if (null !== $this->yearId) {
            $actual = ActualLevel::where('level_id', '!=', $value)
                ->where('student_id', '=', $this->studentId)
                ->where('year_academic_id', '=', $this->yearId)
                ->first();

            if ($actual instanceof ActualLevel) {
                $fail("Vous ne pouvez pas être dans deux dans une promotion dans la même année académique");
            }
        }
    }
}
