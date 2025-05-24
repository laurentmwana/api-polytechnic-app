<?php

namespace Database\Seeders;

use App\Models\Jury;
use App\Models\Level;
use App\Models\Professor;
use App\Models\YearAcademic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JurySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (Level::all() as $level) {

            foreach (YearAcademic::all() as $year) {
                $jury = Jury::create([
                    'level_id' => $level->id,
                    'year_academic_id' => $year->id,
                ]);

                $numberJuries = random_int(7, 8);
                $professorsIds = [];

                for ($i = 0; $i < $numberJuries; $i++) {
                    $professorsIds[] = Professor::all()->random()->id;
                }

                $jury->professors()->sync($professorsIds);
            }
        }
    }
}
