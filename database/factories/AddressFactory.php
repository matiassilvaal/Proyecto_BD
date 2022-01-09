<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ciudad' => $this->faker->unique()->city,
            'id_pais' => Country::all()->random()->id,
            'soft' => false
        ];
    }
}
