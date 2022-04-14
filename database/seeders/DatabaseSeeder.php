<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UsersSeeder::class]);
        $this->call([PropertiesSeeder::class]);
        $this->call([CharacteristicsSeeder::class]);
        $this->call([Rental_availabilitiesSeeder::class]);
        $this->call([PhotographsSeeder::class]);
        $this->call([PropertiesSeeder::class]);
        $this->call([QualificationsSeeder::class]);
        $this->call([Rental_availabilitiesSeeder::class]);
    }
}
