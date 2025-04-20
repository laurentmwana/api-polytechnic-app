<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence();

        $alias = substr($name, 0, 9);
        return [
            'name' => $name,
            'alias' => $alias,
            'description' => fake()->paragraph(),
            'department_id' => Department::all()->random()->id,
        ];
    }
}
