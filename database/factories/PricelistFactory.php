<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pricelist>
 */
class PricelistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'house_id' => '1',
        'saltas_vanduo' => $this->faker->numberBetween(10,180),
        'karstas_vanduo' => $this->faker->numberBetween(10,180),
        'sildymas' => $this->faker->numberBetween(10,180),
        'silumos_mazg_prieziura' => $this->faker->numberBetween(10,180),
        'gyvatukas' => $this->faker->numberBetween(10,180),
        'salto_vandens_abon' => $this->faker->numberBetween(10,180),
        'elektra_bendra' => $this->faker->numberBetween(10,180),
        'ukio_islaid' => $this->faker->numberBetween(10,180),
        'nkf'=> $this->faker->numberBetween(10,180),
        'created_at'=> $this->faker->date(),
        ];
    }
}
