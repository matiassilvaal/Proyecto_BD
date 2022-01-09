<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre' => $this->faker->unique()->currencyCode,
            'Transformacion' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 20),
            'soft' => false
        ];
    }
}
