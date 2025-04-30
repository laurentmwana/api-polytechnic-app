<?php

namespace App\Rules;

use App\Enums\NumberPhoneEnum;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NumberPhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $prefix = substr($value, 0, 3);

        $networks  = array_map(
            function (NumberPhoneEnum $enum) use ($prefix): bool {
                return str_contains($prefix, $enum->value);
            },
            NumberPhoneEnum::cases(),
        );

        if (in_array(true, $networks)) {
            $fail("{$attribute} n'est pas valide");
        }
    }
}
