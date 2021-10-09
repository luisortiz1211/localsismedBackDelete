<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\PhysicalExam;
use App\Patient;
use App\User;

use Tymon\JWTAuth\Facades\JWTAuth;

class PhysicalExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PhysicalExam::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $patients = Patient::all();
        $users = User::all();

        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            //$num_patients = 5;
            //for ($i = 0; $i < $num_patients; $i++)
            foreach ($patients as $patient) {
                PhysicalExam::create([
                    'patient_id' => $patient->id,
                    'user_id' => $user->id,
                    
                    'heartRate' => $faker->randomFloat(
                        $nbMaxDecimals = 2,
                        $nim = 0,
                        $max = 200
                    ),
                    'bloodPleasure' => $faker->word,
                    'weight' => $faker->randomFloat(
                        $nbMaxDecimals = 2,
                        $nim = 5,
                        $max = 300
                    ),
                    'height' => $faker->randomFloat(
                        $nbMaxDecimals = 2,
                        $nim = 30,
                        $max = 300
                    ),
                    'idealWeight' => $faker->randomFloat(
                        $nbMaxDecimals = 2,
                        $nim = 0,
                        $max = 200
                    ),
                    'temp' => $faker->randomFloat(
                        $nbMaxDecimals = 2,
                        $nim = 20,
                        $max = 100
                    ),
                    'tobacco' => $faker->boolean,
                    'alcohol' => $faker->boolean,
                    'drugs' => $faker->boolean,
                    'apetiteChanges' => $faker->boolean,
                    'dreamChanges' => $faker->boolean,
                    'currentCondition' => $faker->paragraph,
                    'comment' => $faker->sentence,
                    'currentDrug' => $faker->word,
                    'schedule_day'=>$patient->id,
                ]);
            }
        }
    }
}
