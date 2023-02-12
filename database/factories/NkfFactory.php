<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nkf>
 */
class NkfFactory extends Factory
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
            'amountPayed' => $this->faker->unique()->numberBetween(1,30),
            'description' => $this->faker->numberBetween(27,100),
            'type' => $this->faker->numberBetween(1,100),
            'like'=> '0',
            'dislike'=> '0',
        ];
    }
}
