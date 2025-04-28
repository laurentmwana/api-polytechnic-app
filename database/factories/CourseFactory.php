<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Professor;
use App\Enums\SemesterEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'credits' => fake()->randomDigit(),
            'semester' => fake()->randomElement(SemesterEnum::cases())->value,
            'professor_id' => Professor::all()->random()->id,
            'level_id' => Level::all()->random()->id,
        ];
    }
}
