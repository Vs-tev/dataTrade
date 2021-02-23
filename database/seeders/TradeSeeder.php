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
        /*       $data = [];
            $user = collect(\App\Models\User::all()->modelKeys());
            $portfolio = collect(\App\Models\Portfolio::all()->modelKeys());
        

            for($i = 0; $i < 10; $i++){
                $data[] = [
                    'user_id' => $user->random(),
                    'portfolio_id' => $portfolio->random(),
                    'symbol' => 'EUR/USD',
                    'type_side' => 'sell',
                    'quantity' => rand(500, 10000),
                    'entry_price' => rand(1.0000, 1.2500),
                    'exit_price' => rand(1.0000, 1.2500),
                    'stop_loss_price' => rand(1.0000, 1.2500),
                    'time_frame' => '15 min',
                    'entry_date' => now()->toDateTimeString(),
                    'exit_date' => now()->toDateTimeString(),
                    'pl_currency' => rand(50, 250),
                    'pl_pips' => rand(10, 150),
                    'fees' => rand(2, 15),
                    'trade_notes' => 'asjdhbaskjdnaksdjnasjdnlasdk',
                ];
            };

            foreach($data as $trade){
            \App\Models\Trade::create($trade);

        } */

        //on TradeFactory and BalanceFactory we prepare the data for databse
        //here we we insert into trades and into related tables wich is balance and fill related data like so . 
        //also we can do this for used_entry_rules and so on.

        \App\Models\Trade::factory(5000)
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
