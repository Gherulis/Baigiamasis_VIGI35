<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\house>
 */
class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'adress' => $this->faker->streetName(),
            'house_nr' => $this->faker->numberBetween(1,100),
            'city' => $this->faker->numberBetween(10,180),
            'house_size' => $this->faker->numberBetween(2000,5000),

        ];
    }
}
