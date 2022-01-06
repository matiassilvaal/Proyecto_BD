<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class MethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_tarjeta' => Card::all()->random()->id,
            'numero' => $this->faker->unique()->creditCardNumber,
            'nombre' => $this->faker->name,
            'fecha_de_vencimiento' => $this->faker->creditCardExpirationDate
        ];
    }
}
