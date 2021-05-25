<?php

namespace Database\Factories;

use App\Models\TradePerformance;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradePerformanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradePerformance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pow_2' => 12.45,
        ];
    }
}
