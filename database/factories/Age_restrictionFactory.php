<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Age_restrictionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Restriccion' => $this->faker->numberBetween($min = 0, $max = 4)
            /**
             * 0 = 3 años o más
             * 1 = 7 o más
             * 2 = 12 o más
             * 3 = 16 o más
             * 4 = 18 o más
             */
        ];
    }
}
