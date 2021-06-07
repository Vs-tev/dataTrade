<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Portfolio;
use App\Models\EntryRules;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;
class EntryRulesTest extends TestCase
{
    use RefreshDatabase;
    

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Portfolio::factory()->create(['user_id' => 1]);

        Gate::before(function () {
            return true;
        });
    }


    /** @test */ 
    public function only_logged_in_users_can_see_entry_rules()
   {
        $response = $this->get('/dashboardPages/tradingrules')->assertRedirect('/login');
   }

   /** @test */ 
   public function only_logged_in_users_and_user_has_portfolio_can_add_entry_rules()
   {
        //$this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $response = $this->postJson('/dashboardPages/tradingrules/entry_rules/p', [
            'name' => 'testss',
            'user_id' => 1,  
        ]);

        $this->assertCount(1 , EntryRules::all());
       
   }

    /** @test */ 
    public function a_name_is_required()
    {

        $this->actingAs($this->user);

        $response = $this->post('/dashboardPages/tradingrules/entry_rules/p', [
            'name' => '',
            'user_id' => 1,  
        ]);
        
        $response->assertSessionHasErrors('name');
        $this->assertCount(0 , EntryRules::all());
    }

    /** @test */ 
    public function entry_rule_can_be_updated(Type $var = null)
    {
        $this->actingAs($this->user);

        $this->post('/dashboardPages/tradingrules/entry_rules/p', [
            'name' => 'Test Rule',
            'user_id' => 1,  
        ]);

        $entryRule = EntryRules::first();

        $this->put('/dashboardPages/tradingrules/entry_rules/u/' .$entryRule->id, [
            'name' => 'Test Rule Name',
            'user_id' => 1,  
        ]);

        $this->assertEquals('Test Rule Name', EntryRules::first()->name);
    }

    /** @test */ 
    public function entry_rule_can_be_deleted()
    {
       // $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $response = $this->postJson('/dashboardPages/tradingrules/entry_rules/p', [
            'name' => 'testss',
            'user_id' => 1,  
        ]);

        $entryRule = EntryRules::first();

        $this->assertCount(1, EntryRules::all());

        $response = $this->deleteJson('/dashboardPages/tradingrules/entry_rules/d/' .$entryRule->id);

        $this->assertCount(0, EntryRules::all());
    }
   
}
