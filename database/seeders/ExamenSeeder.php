<?php

namespace Database\Seeders;

use App\Models\Examen;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $startDate = Carbon::createFromTimestamp($faker->dateTimeBetween('-1 years', '+1 month')->getTimestamp());

        Examen::create([
            "name" => "Examen CDA",
            "beginAt" => $startDate->toDateTimeString(),
            "endAt" => $startDate->addHours($faker->numberBetween(1, 8)),
        ]);
    }
}
