<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Permiso' => $this->faker->unique()->realText($maxNbChars = 200),
            'soft' => false
        ];
    }
}
