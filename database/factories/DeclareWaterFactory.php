<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\declareWater>
 */
class DeclareWaterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'flat_id' => $this->faker->unique->numberBetween(1,5),
            'kitchen_cold' => $this->faker->numberBetween(50,850),
            'kitchen_cold_usage' => $this->faker->numberBetween(1,15),
            'kitchen_hot' => $this->faker->numberBetween(50,850),
            'kitchen_hot_usage' => $this->faker->numberBetween(1,15),
            'bath_cold' => $this->faker->numberBetween(50,850),
            'bath_cold_usage' =>$this->faker-> numberBetween(1,15),
            'bath_hot' => $this->faker->numberBetween(50,850),
            'bath_hot_usage' => $this->faker->numberBetween(1,15),
            'declaredBy' => $this->faker->firstName(),
            'created_at' => $this->faker->dateTimeBetween('-1 months', 'now'),

        ];
    }
}
