<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = [
            [
                "name" => "Free",
                "price" => 0,
                "plan_description" => "Everything what you need to keep track on your trading",
                "stripe_plan_id" => "price_1IRvLICMBVtVAvVJyjsrkvIa",
                "billing_period" => "monthly"
            ],
            [
                "name" => "Pro",
                "price" => 299,
                "plan_description" => "Everything in Free, plus more space. Take things to the next level",
                "stripe_plan_id" => "price_1IRvMYCMBVtVAvVJl2zHhKSF",
                "billing_period" => "monthly"
            ],
            [
                "name" => "Premium",
                "price" => 499,
                "plan_description" => "The complete package with maximum space and fetures",
                "stripe_plan_id" => "price_1IRvNECMBVtVAvVJe9Nx22jI",
                "billing_period" => "monthly"
            ],
            

            [
                "name" => "Free",
                "price" => 0,
                "plan_description" => "Everything what you need to keep track on your trading",
                "stripe_plan_id" => "price_1IRvLICMBVtVAvVJyjsrkvIa",
                "billing_period" => "yearly"
            ],
            [
                "name" => "Pro",
                "price" => 2999,
                "plan_description" => "Everything in Free, plus more space. Take things to the next level",
                "stripe_plan_id" => "price_1IT7ahCMBVtVAvVJvy1IjlcR",
                "billing_period" => "yearly"
            ],
            [
                "name" => "Premium",
                "price" => 4999,
                "plan_description" => "The complete package with maximum space and fetures",
                "stripe_plan_id" => "price_1IT7bkCMBVtVAvVJWXOszyaj",
                "billing_period" => "yearly"
            ],
          
        ];

        \App\Models\Feature::insert($plan);
        //php artisan db:seed --class=PlanSeeder
    }
}
