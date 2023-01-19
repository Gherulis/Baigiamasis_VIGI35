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
            'flat_id' => $this->faker->numberBetween(1,30),
            'kitchen_cold' => $this->faker->numberBetween(50,850),
            'kitchen_hot' => $this->faker->numberBetween(50,850),
            'bath_cold' => $this->faker->numberBetween(50,850),
            'bath_hot' => $this->faker->numberBetween(50,850),
            'declaredBy' => $this->faker->firstName(),
            'created_at'=> $this->faker->date(),
        ];
    }
}
