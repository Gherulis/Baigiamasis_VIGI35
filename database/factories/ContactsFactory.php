<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\contacts>
 */
class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vardas' => $this->faker->firstName(),
            'pastas' => $this->faker->unique()->email,
            'tel' => $this->faker->numberBetween(867011111,867999999),
            'komentaras' => $this->faker->jobTitle(),
        ];
    }
}
