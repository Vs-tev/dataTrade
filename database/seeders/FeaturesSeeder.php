<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            ["name" => "portfolios"],
            ["name" => "trades"],
            ["name" => "strategies"],
            ["name" => "entry_rules"],
            ["name" => "exit_reasons"],
        ];

        \App\Models\Feature::insert($features);
        //php artisan db:seed --class=FeaturesSeeder
    }
}
