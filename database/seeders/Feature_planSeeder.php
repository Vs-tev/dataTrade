<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Feature_planSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('feature_plan')->insert(
        ['feature_id' => '1','plan_id' => '1','max_amount' => '1'],
        ['feature_id' => '1','plan_id' => '2','max_amount' => '2'],
        ['feature_id' => '1','plan_id' => '3','max_amount' => '5'],
        ['feature_id' => '2','plan_id' => '1','max_amount' => '100'],
        ['feature_id' => '2','plan_id' => '2','max_amount' => '500'],
        ['feature_id' => '2','plan_id' => '3','max_amount' => '999999'],
        ['feature_id' => '3','plan_id' => '1','max_amount' => '2'],
        ['feature_id' => '3','plan_id' => '2','max_amount' => '5'],
        ['feature_id' => '3','plan_id' => '3','max_amount' => '10'],
        ['feature_id' => '4','plan_id' => '1','max_amount' => '5'],
        ['feature_id' => '4','plan_id' => '2','max_amount' => '10'],
        ['feature_id' => '4','plan_id' => '3','max_amount' => '20'],
        ['feature_id' => '5','plan_id' => '1','max_amount' => '5'],
        ['feature_id' => '5','plan_id' => '2','max_amount' => '10'],
        ['feature_id' => '5','plan_id' => '3','max_amount' => '20'],
        ['feature_id' => '1','plan_id' => '5','max_amount' => '1'],
        ['feature_id' => '2','plan_id' => '5','max_amount' => '100'],
        ['feature_id' => '3','plan_id' => '5','max_amount' => '2'],
        ['feature_id' => '4','plan_id' => '5','max_amount' => '5'],
        ['feature_id' => '5','plan_id' => '5','max_amount' => '5'],
        ['feature_id' => '1','plan_id' => '6','max_amount' => '2'],
        ['feature_id' => '2','plan_id' => '6','max_amount' => '500'],
        ['feature_id' => '3','plan_id' => '6','max_amount' => '5'],
        ['feature_id' => '4','plan_id' => '6','max_amount' => '10'],
        ['feature_id' => '5','plan_id' => '6','max_amount' => '10'],
        ['feature_id' => '1','plan_id' => '7','max_amount' => '5'],
        ['feature_id' => '2','plan_id' => '7','max_amount' => '999999'],
        ['feature_id' => '3','plan_id' => '7','max_amount' => '10'],
        ['feature_id' => '4','plan_id' => '7','max_amount' => '20'],
        ['feature_id' => '5','plan_id' => '7','max_amount' => '20'],
      );
      //php artisan db:seed --class=Feature_planSeeder
    }
}
