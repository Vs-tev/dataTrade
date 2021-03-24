<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Portfolio::factory(1)->create();
        //call php artisan db:seed --class=PortfolioSeeder
    }
}
