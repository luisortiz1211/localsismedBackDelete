<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
         $this->call(PatientsTableSeeder::class);
        $this->call(ScheduleUsersTableSeeder::class);
        $this->call(ScheduleDaysTableSeeder::class);
        $this->call(EmergencyContactsTableSeeder::class);
        $this->call(PersonalHistoriesTableSeeder::class);
        $this->call(DrugsAllergiesTableSeeder::class);
        $this->call(FamilyHistoriesTableSeeder::class);
        $this->call(PhysicalExamsTableSeeder::class);
        $this->call(ExplorationPatientsTableSeeder::class);
        $this->call(DrugsRecipiesTableSeeder::class);
        $this->call(ImageRecipiesTableSeeder::class); 
        Schema::enableForeignKeyConstraints();
    }
}