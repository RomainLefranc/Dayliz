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

        for ($i = 0; $i < 20; $i++) {

            Activity::create([
                "title" => $faker->text(50),
                "description" => $faker->text(100),
                "state" => true,
                //"duree" => $faker->time('H:i'),
                "duree" => $faker->numberBetween(60,86400),
                'order' => $i+1,
                "examen_id" => $faker->numberBetween(1,2),
                "user_id" => $faker->numberBetween(1,19)
            ]);

        }



    }
}
