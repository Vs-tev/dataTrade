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
        $this->call(UserSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(FeaturesSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(FeaturePlanSeeder::class);
        $this->call(SymbolSeeder::class);
    }
}
