<?php

namespace Database\Factories;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Portfolio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'start_equity' => rand(500, 10000),
            'started_at' => $this->faker->dateTimeBetween('2021-03-06', '2021-03-07'),
            'currency' => $this->faker->randomElement(['EUR', 'CAD']),
            'user_id' => 1,
            'is_active' => 1,
        ];
    }
}
