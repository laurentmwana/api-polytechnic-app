<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Level;
use App\Models\Course;
use App\Models\Option;
use App\Models\Faculty;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Programme;
use App\Models\Department;
use App\Models\University;
use App\Models\ActualLevel;
use App\Models\AcademicFees;
use App\Models\YearAcademic;
use App\Models\CourseFollowed;
use App\Models\LaboratoryFees;
use Illuminate\Database\Seeder;
use App\Enums\GradeProfessorEnum;
use App\Enums\SpatieUserRoleEnum;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SpatiePermissionSeeder::class);

        User::factory()->create([
            'name' => 'Labeya',
            'email' => 'demo@gmail.com',
        ])->each(function (User $user) {
            $user->assignRole(
                Role::findByName(SpatieUserRoleEnum::ROLE_ADMIN->value)
            );
        });

        User::factory()->create()->each(function (User $user) {
            $user->assignRole(
                Role::findByName(SpatieUserRoleEnum::ROLE_ANONYMOUS->value)
            );
        });

        University::factory(1)->create();

        Faculty::factory(16)->create();

        Department::factory(6)->create();
        Option::factory(12)->create();

        Programme::factory(10)->create();

        YearAcademic::factory()->create(['is_closed' => false]);

        YearAcademic::factory(3)->create();

        Level::factory(10)->create();

        $students = Student::factory(20)->create();

        Professor::factory()->create([
            'grade' => GradeProfessorEnum::DEAN->value,
        ]);

        Professor::factory()->create([
            'grade' => GradeProfessorEnum::VICE_DEAN->value,
        ]);

        Professor::factory()->create([
            'grade' => GradeProfessorEnum::RESEARCH_COORDINATOR->value,
        ]);

        Professor::factory(25)->create();

        Course::factory(50)->create();

        foreach ($students as $student) {

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
    }
}
