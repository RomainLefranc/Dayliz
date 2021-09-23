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
                "password" => password_hash('salut',PASSWORD_BCRYPT),
                "phoneNumber" => $faker->phoneNumber,
                "birthDay" => $faker->date(),
                "promotion_id" => $faker->numberBetween(1,2),
                "role_id" => 1,
                "state" => true
            ]);
        }
        User::create([
            "firstName" => 'Admin',
            "lastName" => 'Admin',
            "email" => 'admin@gmail.com',
            "password" => password_hash('admin',PASSWORD_BCRYPT),
            "phoneNumber" => $faker->phoneNumber,
            "birthDay" => $faker->date(),
            "promotion_id" => null,
            "role_id" => 1,
            "state" => true
        ]);
    }
}
