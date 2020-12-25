<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween($min = 5, $max = 600),
            'action_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'action_type' => 'transaction',
            'portfolio_id' => $this->faker->numberBetween($min = 1, $max = 1),
        ];
    }
}
