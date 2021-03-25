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
        ['id' => '1','feature_id' => '1','plan_id' => '1','max_amount' => '1'],
        ['id' => '2','feature_id' => '1','plan_id' => '2','max_amount' => '2'],
        ['id' => '3','feature_id' => '1','plan_id' => '3','max_amount' => '5'],
        ['id' => '4','feature_id' => '2','plan_id' => '1','max_amount' => '100'],
        ['id' => '5','feature_id' => '2','plan_id' => '2','max_amount' => '500'],
        ['id' => '6','feature_id' => '2','plan_id' => '3','max_amount' => '999999'],
        ['id' => '7','feature_id' => '3','plan_id' => '1','max_amount' => '2'],
        ['id' => '8','feature_id' => '3','plan_id' => '2','max_amount' => '5'],
        ['id' => '9','feature_id' => '3','plan_id' => '3','max_amount' => '10'],
        ['id' => '10','feature_id' => '4','plan_id' => '1','max_amount' => '5'],
        ['id' => '11','feature_id' => '4','plan_id' => '2','max_amount' => '10'],
        ['id' => '12','feature_id' => '4','plan_id' => '3','max_amount' => '20'],
        ['id' => '13','feature_id' => '5','plan_id' => '1','max_amount' => '5'],
        ['id' => '14','feature_id' => '5','plan_id' => '2','max_amount' => '10'],
        ['id' => '15','feature_id' => '5','plan_id' => '3','max_amount' => '20'],
        ['id' => '16','feature_id' => '1','plan_id' => '5','max_amount' => '1'],
        ['id' => '17','feature_id' => '2','plan_id' => '5','max_amount' => '100'],
        ['id' => '18','feature_id' => '3','plan_id' => '5','max_amount' => '2'],
        ['id' => '19','feature_id' => '4','plan_id' => '5','max_amount' => '5'],
        ['id' => '20','feature_id' => '5','plan_id' => '5','max_amount' => '5'],
        ['id' => '21','feature_id' => '1','plan_id' => '6','max_amount' => '2'],
        ['id' => '22','feature_id' => '2','plan_id' => '6','max_amount' => '500'],
        ['id' => '23','feature_id' => '3','plan_id' => '6','max_amount' => '5'],
        ['id' => '24','feature_id' => '4','plan_id' => '6','max_amount' => '10'],
        ['id' => '25','feature_id' => '5','plan_id' => '6','max_amount' => '10'],
        ['id' => '26','feature_id' => '1','plan_id' => '7','max_amount' => '5'],
        ['id' => '27','feature_id' => '2','plan_id' => '7','max_amount' => '999999'],
        ['id' => '28','feature_id' => '3','plan_id' => '7','max_amount' => '10'],
        ['id' => '29','feature_id' => '4','plan_id' => '7','max_amount' => '20'],
        ['id' => '30','feature_id' => '5','plan_id' => '7','max_amount' => '20'],
      );
      //php artisan db:seed --class=Feature_planSeeder
    }
}
