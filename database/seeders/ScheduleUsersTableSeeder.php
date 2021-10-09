<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\ScheduleUser;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ScheduleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //vaciamos la tabla horarios de usuario
        ScheduleUser::truncate();
        $faker = \Faker\Factory::create();
        //obtenemos los usuarios
        $users = User::all();
        $startTime = '9:00';
        $finishTime = '17:00';
        $scheduleStart= 0;
        foreach ($users as $user) {
            //iniciamos sesion con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            foreach ($users as $user) {
                ScheduleUser::create([
                    'user_id' => $user->id,
                    'userDay' => $faker->dayOfWeek,
                    'startTime' => $startTime,
                    'finishTime' => $finishTime,
                    'availableStatus'=>$scheduleStart,
           
                ]);
            }
        }
    }
}
