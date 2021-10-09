<?php

namespace Database\Seeders;
use App\Patient;
use App\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        // Vaciar la tabla.
        Patient::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $users = User::all();

        foreach ($users as $user) {
            // sesion de usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            foreach ($users as $user) {
                Patient::create([
                    'user_id' => $user->id,
                    'ci' => $faker->isbn13,
                    'name' => $faker->name,
                    'lastName' => $faker->lastName,
                    'sex' => $faker->numberBetween($min = 1, $max = 2),
                    'civilStatus' => $faker->numberBetween($min = 1, $max = 5),
                    'birthay' => $faker->date,
                    'employment' => $faker->catchPhrase,
                    'email' => $faker->email,
                    'movil' => $faker->e164PhoneNumber,
                    'landline' => $faker->e164PhoneNumber,
                    'address' => $faker->streetAddress,
                    'nationality' => $faker->country,
                    'city' => $faker->city,
                    'parish' => $faker->state,
                ]);
            }
        }
    }
}
