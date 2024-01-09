<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // \App\Models\User::factory(10)->create();
    // }
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(FlightStatuSeeder::class);
        $this->call(TravelClassSeeder::class);
    }
}
