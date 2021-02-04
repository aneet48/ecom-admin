<?php

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
        $this->call(UserSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(UniversitiesSeeder::class);
        $this->call(ProductCategoriesSeeder::class);
        $this->call(SellersSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(EventCategoriesSeeder::class);
        $this->call(EventsSeeder::class);

    }
}
