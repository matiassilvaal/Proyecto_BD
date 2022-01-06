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
            'SO' => $this->faker->text($maxNbChars = 50),
            'CPU' => $this->faker->text($maxNbChars = 50),
            'RAM' => $this->faker->numberBetween($min = 0, $max = 32),
            'GPU' => $this->faker->text($maxNbChars = 100),
            'DirectX' => $this->faker->randomDigitNotNull,
            'RED' => $this->faker->text($maxNbChars = 100),
            'Uso de disco' => $this->faker->numberBetween($min = 10, $max = 120)
        ];
    }
}
