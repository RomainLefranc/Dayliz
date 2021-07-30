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

        Activity::create([
            "title" => 'Installation du materiel',
            "description" => $faker->text(100),
            "state" => true,
            "duree" => '00:20',
            "examen_id" => 1
        ]);

        Activity::create([
            "title" => 'Presentation du projet',
            "description" => $faker->text(30),
            "state" => true,
            "duree" => '00:30',
            "examen_id" => 1
        ]);

        Activity::create([
            "title" => 'Question sur le sujet',
            "description" => $faker->text(30),
            "state" => true,
            "duree" => '00:40',
            "examen_id" => 1
        ]);
    }
}
