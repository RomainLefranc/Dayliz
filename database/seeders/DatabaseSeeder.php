<?php

namespace Database\Seeders;

use App\Models\Examen;
use App\Models\Promotion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            PromotionSeeder::class,
            UserSeeder::class,
            ExamenSeeder::class,
            ActivitySeeder::class
            
            
        ]);
    }
}
