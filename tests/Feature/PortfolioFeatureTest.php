<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Balance;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Gate;


class PortfolioFeatureTest extends TestCase
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
    public function if_user_has_no_portfolio_cannot_see_portfolio_page_and_redirect_to_creation_form()
    {
        $this->actingAs($this->user);

        $this->get('/dashboardPages/portfolio')->assertRedirect('/create_first_portfolio');
    }

     /** @test */ 
    public function user_can_create_portfolio()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/dashboardPages/portfolio/store', [
            'name' => 'Test name',
            'currency' => 'EUR',
            'start_equity' => 4568,
            'started_at' => now()->subDays(7),
        ]);

        $this->assertCount(1 , Portfolio::all());
    }

    /** @test */ 
    public function user_can_update_portfolio()
    {
        $this->actingAs($this->user);

        $this->postJson('/dashboardPages/portfolio/store', [
            'name' => 'Test name',
            'currency' => 'EUR',
            'start_equity' => 4568,
            'started_at' => now()->subDays(7),
            'user_id' => $this->user->id
        ]);

        $portfolio = Portfolio::first();

        $this->put('/dashboardPages/portfolio/update/'.$portfolio->id, [
            'name' => 'Test name updated',
            'currency' => 'CAD',
        ]);

        $this->assertEquals('Test name updated', Portfolio::first()->name);
        $this->assertEquals('CAD', Portfolio::first()->currency);
    }

    
    /** @test */ 
    public function portfolio_start_date_cannot_be_in_future()
    {
        $this->actingAs($this->user);

        $response = $this->post('/dashboardPages/portfolio/store', [
            'name' => 'Test name',
            'currency' => 'EU',
            'start_equity' => 4568,
            'started_at' => now()->addDay(1),
            'user_id' => $this->user->id
        ]);
        
        $response->assertSessionHasErrors('started_at');
        $response->assertSessionHasErrors('currency');
        $this->assertCount(0 , Portfolio::all());
    }

     /** @test */ 
     public function only_logged_in_users_can_see_portfolios()
     {
          $response = $this->get('/dashboardPages/portfolio')->assertRedirect('/login');
     }
  
      /** @test */ 
      public function when_create_portfolio_balance_table_has_also_create_row()
      {
          $this->actingAs($this->user);
  
          Portfolio::factory()->create();
  
          $portfolio = Portfolio::first();
          //Is the portfolio created
          $this->assertCount(1 , Portfolio::all());
  
          $portfolio->add_to_balance($portfolio);
          
          //Is the first portfolio active
          $this->assertEquals(1, $portfolio->is_active);
         
          //have balance the start amount of portfolio
          $this->assertCount(1 , Balance::all());
          $this->assertEquals(Balance::first()->portfolio_id, $portfolio->id);
          $this->assertEquals(Balance::first()->amount, $portfolio->start_equity);
          $this->assertEquals(Balance::first()->action_type, 'start_capital');
          $this->assertEquals(Balance::first()->action_date, $portfolio->started_at);
      }
  
      /** @test */ 
    public function portfolio_cannot_be_deleted_if_user_has_only_one()
    {
        $this->actingAs($this->user);

        Portfolio::factory(1)->create();

        $portfolio = Portfolio::first();

        $this->assertCount(1 , Portfolio::all());

        $response = $this->deleteJson('/dashboardPages/portfolio/d/'.$portfolio->id);
        
        $response->assertForbidden();
    }

    /** @test */ 
    public function check_if_toggle_active_portfolio_is_working()
    {
        $this->actingAs($this->user);

        //Create First Portfolio
        $first_portfolio = Portfolio::factory()->create();

        //check if is active
        $this->assertCount(1, $first_portfolio->where('is_active',1)->get());

        //Create secon portfolio 
        $this->postJson('/dashboardPages/portfolio/store', [
            'id' => 2,
            'name' => 'Test name',
            'currency' => 'EUR',
            'start_equity' => 4568,
            'started_at' => now()->subDays(7),
        ]);

        //check if 'is_active' is 0
        $this->assertEquals(0, Portfolio::find(2)->is_active);

        //Set inative portfolio to active to active
        $this->postJson('/dashboardPages/portfolio/toggle_active/' .Portfolio::find(2)->id, ['active' => 1]);
        //check if second portfolio is active
        $this->assertEquals(1, Portfolio::find(2)->is_active);
        //check if first portfolio is inactive
        $this->assertEquals(0, Portfolio::first()->is_active);

        //set active portfolio to inactive
        $this->postJson('/dashboardPages/portfolio/toggle_active/' .Portfolio::find(2)->id, ['active' => 0]);
        //check if second portfolio is inactive
        $this->assertEquals(0, Portfolio::find(2)->is_active);
        //check if first portfolio is active
        $this->assertEquals(1, Portfolio::first()->is_active);
    }


}
