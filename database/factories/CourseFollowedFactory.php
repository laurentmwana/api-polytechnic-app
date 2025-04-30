<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Student;
use App\Models\YearAcademic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseFollowed>
 */
class CourseFollowedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::all()->random()->id,
            'year_academic_id' => YearAcademic::all()->random()->id,
            'student_id' => Student::all()->random()->id,
        ];
    }
}
