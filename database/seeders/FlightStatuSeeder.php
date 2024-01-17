<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FlightStatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flight_status')->insert([
            ['name' => 'Done'],
            ['name' => 'Waiting'],
            ['name' => 'Takeoff'],
            ['name' => 'Landing'],
            ['name' => 'Flight'],
            ['name' => 'Boarding'],
            ['name' => 'Delay'],
            ['name' => 'Cancellation'],
            ['name' => 'Emergency landing'],
            ['name' => 'Diversion'],
            ['name' => 'Skidding']
        ]);
    }
}
