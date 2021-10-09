<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\ExplorationPatient;
use App\DrugsRecipie;
use App\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class DrugsRecipiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DrugsRecipie::truncate();
        $faker = \Faker\Factory::create();
        // Crear pacientes ficticios
        $exploratePatient = ExplorationPatient::all();
        $users = User::All();
        foreach ($users as $user) {
            //iniciamos sesion
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            //foreach ($exploratePatient as $explorate) 
            foreach($users as $user){
                $explorate = $user;
                DrugsRecipie::create([
                    'exploration_id' => $explorate->id,
                    'user_id' => $user->id,
                    'patient_id'=>$explorate->id,
                    'coddrug' => $faker->ean8,
                    'nameDrugRecipie' => $faker->word,
                ]);
            }
        }
    }
}
