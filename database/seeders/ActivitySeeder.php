<?php

namespace Database\Seeders;

use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {

            Activity::create([
                "title" => $faker->text(50),
                "description" => $faker->text(100),
                "state" => true,
                "duree" => $faker->time(),
                "examen_id" => 1
            ]);

        }



    }
}
