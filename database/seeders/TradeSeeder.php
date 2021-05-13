<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trade;
class TradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        //on TradeFactory and BalanceFactory we prepare the data for databse
        //here we we insert into trades and into related tables wich is balance and fill related data like so . 
        //also we can do this for used_entry_rules and so on.

        \App\Models\Trade::factory(50)
        ->has(\App\Models\Balance::factory()
            ->state(function(array $attributes, Trade $trade){
                return[
                    'amount' => $trade->pl_currency,
                    'action_date' => $trade->exit_date,
                    'portfolio_id' => $trade->portfolio_id,
                ];
            })
            ->count(1))
        ->create();

        //php artisan db:seed --class=TradeSeeder
    }
}
