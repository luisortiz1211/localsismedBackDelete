<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\ImageRecipie;
use App\ExplorationPatient;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class ImageRecipiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageRecipie::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $exploratePatient = ExplorationPatient::all();
        $users = User::all();
        foreach ($users as $user) {
            //inicio de sesión
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
 
            //foreach ($exploratePatient as $explorate) 
            foreach($users as $user){
                 $explorate=$user ;
                ImageRecipie::create([
                    'exploration_id' => $explorate->id,
                    'user_id' => $user->id,
                    'patient_id'=> $explorate->id,
                    'codimage' => $faker->ean8,
                    'nameImageRecipie' => $faker->word,
                ]);
            }
        }
    }
}
