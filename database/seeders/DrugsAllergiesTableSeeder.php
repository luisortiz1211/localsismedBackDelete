<?php

namespace Database\Seeders;
use App\DrugAllergies;
use App\Patient;

use Illuminate\Database\Seeder;

class DrugsAllergiesTableSeeder extends Seeder
{
    public function run()
    {
        // Vaciar la tabla.
        DrugAllergies::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $patients = Patient::all();
        foreach ($patients as $patient) {
            //$num_patients = 3;
            //for ($i = 0; $i < $num_patients; $i++) {
            DrugAllergies::create([
                'patient_id' => $patient->id,
                'drugName' => $faker->word,
                'drugSymptom' => $faker->paragraph,
                'drugRemark' => $faker->sentence,
            ]);
            //}
        }
    }
}
