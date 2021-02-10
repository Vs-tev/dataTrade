<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\Balance::factory()->create();
        //call php artisan db:seed --class=BalanceSeeder
    }
}
