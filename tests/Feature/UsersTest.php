<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;


class UsersTest extends TestCase
{
    use RefreshDatabase;

     /** @test */ 
   public function new_user_is_with_free_plan_regitered()
   {
       $user = User::factory()->create();
    
       $this->actingAs($user);
       
       $user->newSubscription(
           'default', 'price_1IRvLICMBVtVAvVJyjsrkvIa'
       )->create();

       $this->assertCount(1, User::all());
       $this->assertCount(1, Subscription::all());
       
       $this->assertEquals('price_1IRvLICMBVtVAvVJyjsrkvIa', Subscription::first()->stripe_plan);

   }
}
