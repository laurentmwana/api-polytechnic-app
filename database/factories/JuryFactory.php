<?php

namespace Database\Factories;

use App\Models\YearAcademic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jury>
 */
class JuryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year_academic_id' => YearAcademic::all()->random()->id,
        ];
    }
}
