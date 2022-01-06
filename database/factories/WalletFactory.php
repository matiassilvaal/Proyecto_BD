<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Cantidad' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = NULL)
        ];
    }
}
