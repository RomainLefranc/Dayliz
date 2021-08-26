<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            User::create([
                "firstName" => $faker->firstName(),
                "lastName" => $faker->lastName(),
                "email" => $faker->email,
                "password" => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                "phoneNumber" => $faker->phoneNumber,
                "birthDay" => $faker->date(),
                "promotion_id" => $faker->numberBetween(1,2),
                "role_id" => 1,
                "state" => true
            ]);
        }
    }
}
