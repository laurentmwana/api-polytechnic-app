<?php

namespace App\Rules;

use Closure;
use App\Models\Course;
use Illuminate\Contracts\Validation\ValidationRule;

class CourseInLevelRule implements ValidationRule
{
    public function __construct(private ?string $levelId, private ?string $id) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (null !== $this->levelId) {
            $course = Course::where('id', '!=', $this->id)
                ->where('name', '=', $value)
                ->where('level_id', '=', $this->levelId)
                ->first();

            if ($course instanceof Course) {
                $fail("Il ne peut pas y avoir deux course portant le même nom dans une promotion");
            }
        }
    }
}
