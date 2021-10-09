<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\ExplorationPatient;
use App\PhysicalExam;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExplorationPatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExplorationPatient::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $physicalExam =PhysicalExam::all();
        $users = User::all();
        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            //$num_exams = 1;
            //$role_user = '1';
            //for ($i = 0; $i < $num_exams; $i++)
            foreach ($physicalExam as $exams) {
                ExplorationPatient::create([
                    'physicalExam_id' => $exams->id,
                    'user_id' => $user->id,
                    'patient_id'=>$exams->id,
                    'headExplo' => $faker->sentence,
                    'chestExplo' => $faker->sentence,
                    'extremitiesExplo' => $faker->sentence,
                    'neckExplo' => $faker->sentence,
                    'stomachExplo' => $faker->sentence,
                    'genitalsExplo' => $faker->sentence,
                    'forecastExplo' => $faker->sentence,
                    'diagnosisExplo' => $faker->sentence,
                    'treatmentExplo' => $faker->sentence,
                    'commentExplo' => $faker->sentence,
                ]);
            }
        }
    }
}
