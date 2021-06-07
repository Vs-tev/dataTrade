<?php

namespace Database\Factories;

use App\Models\ExitReason;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExitReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExitReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'user_id' => 1,
        ];
    }
}
