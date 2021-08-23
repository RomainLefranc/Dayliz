<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Promotion::create([
            "name" => "CDA 2021",
            "state" => false
        ]);
        Promotion::create([
            "name" => "DWWW 2021",
            "state" => true
        ]);
    }
}
