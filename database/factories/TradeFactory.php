<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Trade;
use App\Models\Symbol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => 3,
            'portfolio_id' => 3,
            'symbol' => 'EUR/USD',
            'type_side' => $this->faker->randomElement(['sell', 'buy']),
            'quantity' => rand(1000, 10000),
            'entry_price' => $this->faker->numerify('1.#####'),
            'exit_price' => $this->faker->numerify('1.#####'),
            'stop_loss_price' => $this->faker->numerify('1.#####'),
            'time_frame' => $this->faker->randomElement(['1 min', '4 hours']),
            'entry_date' => $this->faker->dateTimeBetween('2021-04-27', '2021-05-02'),
            'exit_date' => $this->faker->dateTimeBetween('2021-05-03', 'now'),
            'pl_currency' => rand(-27, 59),
            'pl_pips' => rand(-10, 30),
            'fees' => rand(2, 6),
            'trade_img' => 'noimage.jpg',
            'trade_notes' => 'Lorem ipsum dolor tas. Dolor repellendus ipsam similique error sunt odit nemo dignissimos minus beatae necessitatibus! Facilis dolores cupiditate explicabo.',
        ];
    }
}
