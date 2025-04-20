<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\YearAcademic>
 */
class YearAcademicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = (int) fake()->year();
        $end = $start + 1;
        $name = sprintf("%s-%s", $start, $end);

        return [
            'name' => $name,
            'start' => $start,
            'end' => $end,
        ];
    }
}
