<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\EmergencyContact;
use App\Patient;

class EmergencyContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmergencyContact::truncate();
        $faker = \Faker\Factory::create();
        $patients = Patient::all();
        foreach ($patients as $patient) {
            //        $num_contacts = 3;
            //          for ($j = 0; $j < $num_contacts; $j++) {
            EmergencyContact::create([
                'patient_id' => $patient->id,
                'nameContact' => $faker->name,
                'movil' => $faker->e164PhoneNumber,
                'landline' => $faker->e164PhoneNumber,
                'relationShip' => $faker->word,
                'bloodType' => $faker->word,
            ]);
            //      }
        }
    }
}
