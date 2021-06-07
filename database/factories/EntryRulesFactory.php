<?php

namespace Database\Factories;

use App\Models\EntryRules;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EntryRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_id' => User::factory(),
            
        ];
    }
}
