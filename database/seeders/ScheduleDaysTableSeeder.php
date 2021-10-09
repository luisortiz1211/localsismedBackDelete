<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Patient;
use App\User;
use App\ScheduleDay;
use App\ScheduleUser;

use Tymon\JWTAuth\Facades\JWTAuth;

class ScheduleDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vaciamos la tabla agenda del dia
        ScheduleDay::truncate();
        $faker = \Faker\Factory::create();
        // obtenemos los paciente
        $users = User::all();
        $patients = Patient::All();
        $schedule = ScheduleUser::All();
        $state = "pendiente";
        foreach ($users as $user) {
            //iniciamos la sesion con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            //ScheduleDay::create([]);
            foreach ($patients as $patient) {
                $schedule= $patient;
                ScheduleDay::create([
                    'user_id' => $user->id,
                    'patient_id' => $patient->id,
                    'schedule_id'=> $schedule->id,
                    'scheduleDay' => $faker->dayOfWeek,
                    'scheduleTime' => $faker->dateTimeBetween(
                        $min = '9:00',
                        $max = '17:00'
                    ),
                    'userAssigned'=>$faker->numberBetween($min = 1, $max = 4),
                    //'availableStatus' => $faker->boolean,
                    'scheduleDayState'=>$state
                ]);
            }
        }
    }
}
