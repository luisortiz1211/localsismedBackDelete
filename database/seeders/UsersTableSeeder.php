<?php
namespace Database\Seeders;
use App\User;
use App\Admin;
use App\Assistent;
use App\Medic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();
        $faker = \Faker\Factory::create();
        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');
        $admin =Admin::create(['ci' =>'123456789','employment' =>'Medicina General']);

        $admin->user()->create([
            'name' => 'Administrador',
            'lastName' => 'Admin',
            'email' => 'admin@prueba.com',
            'availableStatus' => '1',
            'password' => $password,
            'roleUser'=>'ROLE_ADMIN'
       ]);
        // Generar algunos usuarios para nuestra aplicacion
        //$num_user = 3;
        for ($i = 0; $i < 5; $i++) {
            $assistent = Assistent::create([
                'ci'=>$faker->isbn13,
                'employment'=>$faker->catchPhrase,
            ]);
            $medic = Medic::create([
                'ci' =>$faker->isbn13,
                'employment'=>$faker->word,
            ]);

            if ($i % 2 == 0){
                $assistent->user()->create([
                    'name' => $faker->firstName,
                    'lastName' => $faker->lastName,
                    'email' => $faker->email,
                    'password' => $password,
                    'availableStatus' => $faker->boolean,
                    'roleUser' => 'ROLE_ASSISTENT',
                ]);
            }else{
                $medic->user()->create([
                    'name' => $faker->firstName,
                    'lastName' => $faker->lastName,
                    'email' => $faker->email,
                    'password' => $password,
                    'availableStatus' => $faker->boolean,
                    'roleUser' => 'ROLE_MEDIC',
                ]);
            }
            
        }
    }
}
