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

        for ($i = 1; $i <= 5; $i++) {
            $startDate = Carbon::createFromTimestamp($faker->dateTimeBetween('-1 years', '+1 month')->getTimestamp());

            Activity::create([
                "title" => 'activité ' . $i,
                "description" => $faker->text(30),
                "state" => true,
                "duree" => '1 min',
                "examen_id" => 1
            ]);
        }
    }
}
