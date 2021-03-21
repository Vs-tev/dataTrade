<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PortfoliosTest extends TestCase
{
    use RefreshDatabase;

   /** @test */ 

   public function only_users_with_portfolios_cann_see_dashboards()
   {
        $response = $this->get('/dashboardPages/portfolio')->assertRedirect('/login');
   }

    /** @test */ // <- with this special anotatiion work test or with function that start with "test"

    /** @test */ 
    


}
