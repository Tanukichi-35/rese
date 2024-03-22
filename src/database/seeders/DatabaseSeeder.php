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
        $this->call([
            UsersTableSeeder::class,
            AreasTableSeeder::class,
            CategoriesTableSeeder::class,
            StoresTableSeeder::class,
            AdminsTableSeeder::class,
        ]);        
        // $this->call(UsersTableSeeder::class);
        // $this->call(AreasTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(StoresTableSeeder::class);
        // $this->call(AdminsTableSeeder::class);
        \App\Models\Manager::factory(20)->create();
    }
}
