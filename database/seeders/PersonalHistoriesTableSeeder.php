<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Patient;
use App\PersonalHistory;

class PersonalHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        PersonalHistory::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $patients = Patient::all();
        foreach ($patients as $patient) {
            //     $num_patients = 5;
            //    for ($i = 0; $i < $num_patients; $i++) {
            PersonalHistory::create([
                'patient_id' => $patient->id,
                'nameCondition' => $faker->sentence,
                'yearCondition' => $faker->numberBetween($min = 1, $max = 20),
                'commentCondition' => $faker->text,
            ]);
            //  }
        }
    }
}
