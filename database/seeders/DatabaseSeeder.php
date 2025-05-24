<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Course;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Student;
use App\Models\Professor;
use App\Models\ActualLevel;
use App\Models\AcademicFees;
use App\Models\YearAcademic;
use App\Models\CourseFollowed;
use App\Models\LaboratoryFees;
use Illuminate\Database\Seeder;
use App\Enums\UserRoleEnum;
use App\Models\Deliberation;
use App\Models\News;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DefaultSeeder::class);

        User::factory()->create([
            'name' => 'Labeya',
            'email' => 'demo@gmail.com',
            'role' => UserRoleEnum::ADMIN->value,
        ]);

        User::factory(100)->create([
            'role' => UserRoleEnum::STUDENT->value,
        ])
            ->each(function (User $user) {
                Student::factory()->create(['user_id' => $user]);
            });

        Professor::factory(25)->create();

        Course::factory(50)->create();

        foreach (Student::all() as $student) {

            $actual = ActualLevel::create([
                'student_id' => $student->id,
                'year_academic_id' => YearAcademic::all()->random()->id,
                'level_id' => Level::all()->random()->id,
            ]);

            for ($index = 0; $index < 3; $index++) {
                $actual->update([
                    'year_academic_id' => YearAcademic::all()->random()->id,
                    'level_id' => Level::all()->random()->id,
                ]);
            }

            CourseFollowed::factory(6)->create([
                'student_id' => $student->id,
            ]);
        }

        foreach (Level::all() as $level) {
            LaboratoryFees::factory()->create([
                'level_id' => $level->id,
            ]);

            AcademicFees::factory()->create([
                'level_id' => $level->id,
            ]);
        }

        $this->call(JurySeeder::class);

        Deliberation::factory(20)->create();
    }
}
