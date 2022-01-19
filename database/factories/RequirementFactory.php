<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'SO' => $this->faker->stateAbbr,
            'CPU' => $this->faker->company,
            'RAM' => $this->faker->numberBetween($min = 0, $max = 32),
            'GPU' => $this->faker->century,
            'DirectX' => $this->faker->numberBetween($min = 9, $max = 15),
            'RED' => $this->faker->numberBetween($min = 0, $max = 32),
            'Uso_de_disco' => $this->faker->numberBetween($min = 10, $max = 120),
            'soft' => false
        ];
    }
}
