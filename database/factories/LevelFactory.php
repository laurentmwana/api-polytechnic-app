<?php

namespace Database\Factories;

use App\Models\Option;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'option_id' => Option::all()->random()->id,
            'programme_id' => Programme::all()->random()->id,
        ];
    }
}
