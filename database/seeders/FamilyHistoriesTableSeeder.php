<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\FamilyHistory;
use App\Patient;

class FamilyHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        FamilyHIstory::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $patients = Patient::all();
        foreach ($patients as $patient) {
            //$num_patients = 3;
            //for ($i = 0; $i < $num_patients; $i++) {
            FamilyHistory::create([
                'patient_id' => $patient->id,
                'nameCondition' => $faker->sentence,
                'yearCondition' => $faker->numberBetween($min = 1, $max = 10),
                'commentCondition' => $faker->text,
            ]);
            //}
        }
    }
}
