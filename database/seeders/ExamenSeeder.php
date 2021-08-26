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

        $examen = Examen::create([
            "name" => "Examen CDA 2021",
            "beginAt" => $startDate->toDateTimeString(),
            "endAt" => $startDate->addHours($faker->numberBetween(1, 8)),
        ]);

        $examen->promotions()->attach(1);

        $examen = Examen::create([
            "name" => "Examen DWWM 2021",
            "beginAt" => $startDate->toDateTimeString(),
            "endAt" => $startDate->addHours($faker->numberBetween(1, 8)),
        ]);

        $examen->promotions()->attach(2);
    }
}
