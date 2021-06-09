<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Balance;
use App\Models\Trade;
use App\Services\PortfolioPerformanceService;
use Illuminate\Support\Facades\Gate;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Gate::before(function () {
            return true;
        });
    }

     /** @test */
     public function check_portfolio_current_balance()
     {
        $this->actingAs($this->user);
     
        $portfolio = Portfolio::factory()->create(['start_equity' => 1500]);
      
        $portfolio->add_to_balance($portfolio);

        $this->assertCount(1, Balance::all());

        Trade::factory(2)->create(['user_id' => 1, 'portfolio_id' => 1, 'pl_currency' => 50.25 ]);
        $trade = Trade::all();
        foreach($trade as $item){
            $item->add_to_balance($item);
        }

        $response = (new PortfolioPerformanceService())->PortfolioData([1], 1, 1);
       
        $this->assertEquals('1 600.50', $response->getOriginalContent()->first()->current_balance);

     }

     
    
}
