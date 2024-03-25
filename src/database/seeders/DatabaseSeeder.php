<?php

namespace Database\Seeders;

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
        \App\Models\User::factory(20)->create();
        \App\Models\Manager::factory(20)->create();

        $this->call([
            UsersTableSeeder::class,
            AreasTableSeeder::class,
            CategoriesTableSeeder::class,
            StoresTableSeeder::class,
            AdminsTableSeeder::class,
        ]);        

        \App\Models\Booking::factory(100)->create();
        \App\Models\Favorite::factory(100)->create();
        \App\Models\Review::factory(100)->create();
    }
}
