<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TravelClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $travelClasses = [
            ['name' => 'First Class', 'description' => 'This class provides a luxurious experience with luxurious, convertible seats, high-level personal service, and a luxurious food menu.' , 'image' => 'FirstClass.jpg'],
            ['name' => 'Business Class', 'description' => 'This class offers comfortable, convertible seats, high-level service with a varied food menu, and a private workspace.' , 'image' => 'BusinessClass.jpg'],
            ['name' => 'Premium Economy Class', 'description' => 'This class offers comfortable seats with more legroom and better food and entertainment service than regular Economy Class.' , 'image' => 'PremiumEconomyClass.jpg'],
            ['name' => 'Economy Class', 'description' => 'This is the most economical class and offers simple seats with limited legroom and basic food service.' , 'image' => 'EconomyClass.jpg'],
            ['name' => 'Disabled', 'description' => ' ' , 'image' => ' '],
        ];

        foreach ($travelClasses as $class) {
            DB::table('travel_classes')->insert($class);
        }
    }
}
