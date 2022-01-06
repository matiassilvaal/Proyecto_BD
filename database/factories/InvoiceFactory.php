<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Method;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario' => User::all()->random()->id,
            'id_metodo' => Method::all()->random()->id,
            'precio' => $this->faker->randomNumber(5)
        ];
    }
}
