<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Trade;
use App\Models\Portfolio;
use App\Models\User;
use App\Models\Balance;
use App\Models\TradePerformance;
use App\Models\EntryRules;
use App\Models\ExitReason;
use App\Models\Strategy;
use App\Models\Used_entry_rules;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\Request;

class TradeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Portfolio::factory()->create(['user_id' => 1]);
        ExitReason::factory(2)->create(['user_id' => 1]);
        Strategy::factory(2)->create(['user_id' => 1]);
       
        Gate::before(function () {
            return true;
        });
    }

    /** @test */ 
    public function user_can_record_trade()
    {
       // $this->withoutExceptionHandling();
        
        $this->actingAs($this->user);
        
        EntryRules::factory()->create(['user_id' => $this->user->id]);

        $response = $this->postJson('/dashboardPages/traderecord/p',[
            'create' => true,
            'trade_return' => 2,
            'risk_reward' => 1.78,
            'user_id' => 1,
            'portfolio_id' => 1,
            'symbol' => 'EUR/USD',
            'type_side' => 'sell',
            'quantity' => rand(1000, 10000),
            'entry_price' => 1,
            'exit_price' => 1,
            'stop_loss_price' => 1,
            'time_frame' => '4 hours',
            'entry_date' => '2021-06-06',
            'exit_date' => '2021-06-07',
            'pl_currency' => 22,
            'pl_pips' => 2,
            'fees' => 1,
            'trade_img' => null,
            'trade_notes' => 'Lorem i',
            'entry_rule_id' => 1,
            'exit_reason_id' => 1,
            'strategy_id' => 1,
        ]);

        //check if trade is recorder
        $this->assertCount(1, Trade::all());

        //check if Trade performance table has new record
        $this->assertCount(1, TradePerformance::all());

        //check if balances table has new record
        $this->assertCount(1, Balance::all());

        //check if Entry Rules has been addet to table used entry rules
        $this->assertCount(1, Used_entry_rules::all());
    }

    /** @test */ 
    public function user_can_update_trade()
    {
        $this->actingAs($this->user);

        EntryRules::factory(2)->create(['user_id' => $this->user->id]);

        $trade = $this->postJson('/dashboardPages/traderecord/p',[
            'create' => true,
            'trade_return' => 2,
            'risk_reward' => 1.78,
            'user_id' => 1,
            'portfolio_id' => 1,
            'symbol' => 'EUR/USD',
            'type_side' => 'buy',
            'quantity' => rand(1000, 10000),
            'entry_price' => 1,
            'exit_price' => 1,
            'stop_loss_price' => 1,
            'time_frame' => '4 hours',
            'entry_date' => '2021-06-06',
            'exit_date' => '2021-06-07',
            'pl_currency' => 22,
            'pl_pips' => 2,
            'fees' => 1,
            'trade_img' => null,
            'trade_notes' => 'Lorem i',
            'entry_rule_id' => '1, 2',
            'exit_reason_id' => 2,
            'strategy_id' => 2,
        ]);

        $trade = Trade::first();

        //check if Entry Rules has been addet to table used entry rules
        $this->assertCount(2, Used_entry_rules::all());

        $this->assertCount(1, Trade::all());

        $response = $this->postJson('/dashboardPages/tradehistory/update/'.$trade->id ,[
            'symbol' => 'AUD/CAD',
            'type_side' => 'sell',
            'quantity' => '3',
            'entry_price' => 32.00000,
            'exit_price' => 32.0000,
            'stop_loss_price' => 3.00000,
            'time_frame' => '2 hours',
            'risk_reward' => 1.5,
            'trade_img' => null,
            'entry_rule_id' => 2,
            'exit_reason_id' => 1,
            'strategy_id' => 1,
        ]);

        $this->assertEquals('AUD/CAD', Trade::first()->symbol);
        $this->assertEquals('sell', Trade::first()->type_side);

        $this->assertEquals(1, Trade::first()->exit_reason_id);
        $this->assertEquals(1, Trade::first()->strategy_id);

        //check if used_entry_rules table has been updated
        $this->assertCount(1, Used_entry_rules::all());
        $this->assertEquals(2, Used_entry_rules::first()->entry_rule_id);
           
        //check if trade_performance table has been updated
        $this->assertEquals(1.5, TradePerformance::first()->ratio);
    }

     /** @test */ 
    public function delete_all_foreigen_data_when_trade_is_deleted()
    {
        $this->actingAs($this->user);

        //Creating Trade
        $trade = Trade::factory()->create(['user_id' => 1, 'portfolio_id' => 1 ]);
      
        //Add data to balance
        $trade->add_to_balance($trade); 
        //add data to trade_performance table
        $trade->add_to_trade_performance(array_merge($trade->getRawOriginal(), ['trade_return' => 1.5, 'risk_reward' => 2.8]));
    
        //check if trade has been recorded
        $this->assertCount(1, Trade::all());

        //check if Trade performance table has new record
        $this->assertCount(1, TradePerformance::all());

        //check if balances table has new record
        $this->assertCount(1, Balance::all());
      
        //deleting trade
        $response = $this->deleteJson('/dashboardPages/tradehistory/delete/'.$trade->id);
        
        //check if data in related table has been deleted
        $this->assertCount(0, Trade::all());
        $this->assertCount(0, TradePerformance::all());
        $this->assertCount(0, Balance::all());
    }
}
