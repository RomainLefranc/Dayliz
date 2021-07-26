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
            $startDate = Carbon::createFromTimestamp($faker->dateTimeBetween('-1 years', '+1 month')->getTimestamp());

            Activity::create([
                "title" => $faker->text(10),
                "beginAt" => $startDate->toDateTimeString(),
                "endAt" => $startDate->addHours($faker->numberBetween(1, 8)),
                "description" => $faker->text(30),
                "state" => true
            ]);
        }
    }
}
