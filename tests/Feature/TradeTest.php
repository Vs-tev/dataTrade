<?php

namespace Tests\Feature;

use App\Imports\TradesImport;
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

        $response = $this->postJson('/dashboardPages/traderecord/p', [
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
        $this->withoutExceptionHandling();
        $this->actingAs($this->user);

        EntryRules::factory(2)->create(['user_id' => $this->user->id]);

        $trade = $this->postJson('/dashboardPages/traderecord/p', [
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

        $response = $this->postJson('/dashboardPages/tradehistory/update/' . $trade->id, [
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
    public function trade_history_table_test()
    {
        // $this->withoutExceptionHandling();
        $this->actingAs($this->user);
        Portfolio::factory()->create(['user_id' => 1]);

        $trade = new Trade;

        $trade = $trade->factory(14)->create([
            'symbol' => 'EUR/USD',
            'type_side' => 'buy',
            'exit_date' => '2021-05-01 21:34:46',
            'user_id' => 1, 'portfolio_id' => 1,
            'time_frame' => '1 min',
            'pl_currency' => 20
        ]);

        Trade::factory(16)->create([
            'symbol' => 'EUR/CAD',
            'type_side' => 'sell',
            'exit_date' => '2021-05-03 21:34:46',
            'user_id' => 1,
            'portfolio_id' => 2,
            'time_frame' => '15 min',
            'pl_currency' => -20
        ]);

        $params = [
            "portfolio_id" => 2,
            "sort_pl" => "All",
            'type_side' => 'sell',
            "start_date" => '2021-05-02 21:34:46',
            "end_date" => '2021-05-04 21:34:46',
            "display" => 10,
            "search_symbol" => 'EUR/CAD',
            "column" => [
                0 => null,
                1 => "ASC",
            ],
            "except_trade" => false,
            "time_frame" => [
                0 => "15 min",
            ]
        ];

        $response = $this->json('GET', '/dashboardPages/tradehistory/g', $params)->assertOk();

        $data = json_decode($response->getContent(), true);

        $this->assertEquals(10, count($data['data']));
    }
}
