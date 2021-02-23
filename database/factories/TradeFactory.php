<?php

namespace Database\Factories;

use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'portfolio_id' => 17,
            'symbol' => $this->faker->randomElement(['EUR/CAD', 'ERU/USD']),
            'type_side' => $this->faker->randomElement(['sell', 'buy']),
            'quantity' => rand(500, 10000),
            'entry_price' => rand(1.0000, 1.2500),
            'exit_price' => rand(1.0000, 1.2500),
            'stop_loss_price' => rand(1.0000, 1.2500),
            'time_frame' => $this->faker->randomElement(['1 min', '15 min']),
            'entry_date' => $this->faker->dateTimeBetween('2021-01-01', 'now'),
            'exit_date' => $this->faker->dateTimeBetween('2021-01-01', 'now'),
            'pl_currency' => rand(-150, 250),
            'pl_pips' => rand(-50, 250),
            'fees' => rand(2, 12),
            'trade_img' => 'noimage.jpg',
            'trade_notes' => 'asjdhbaskjdnaksdjnasjdnlasdk',
        ];
    }
}
