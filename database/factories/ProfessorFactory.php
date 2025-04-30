<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'firstname' => fake()->firstname,
            'gender' => fake()->randomElement(GenderEnum::cases())->value,
            'number_phone' => fake()->phoneNumber(),
            'department_id' => Department::all()->random()->id,
        ];
    }
}
