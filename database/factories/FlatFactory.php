<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\flat>
 */
class FlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'house_id'=> '1',
            'flat_nr' => $this->faker->unique()->numberBetween(1,30),
            'flat_size' => $this->faker->numberBetween(27,100),
            'gyv_mok_suma' => $this->faker->numberBetween(1,100),

        ];
    }
}
