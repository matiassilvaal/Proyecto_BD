<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Requirement;
use App\Models\Address;
use App\Models\Age_restriction;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_publisher' => User::all()->random()->id,
            'id_requisito' => Requirement::all()->random()->id,
            'id_ubicacion' => Address::all()->random()->id,
            'id_restriccion' => Age_restriction::all()->random()->id,
            'nombre' => $this->faker->streetName,
            'precio' => $this->faker->numberBetween($min = 5, $max = 100),
            /**
             * Tenía argumentos en el ejemplo,
             * no los puse
             */
            'fecha_de_lanzamiento' => $this->faker->date($format = 'Y-m-d'),
            /**
             * Saqué segundo argumento
             */
            'descuento' => $this->faker->numberBetween($min = 1, $max = 100),
            'imagen' => 'https://source.unsplash.com/random/200x200?sig=1',
            'descripcion' => $this->faker->realText($maxNbChars = 600),
            'descarga' => $this->faker->url,
            'demo' => $this->faker->url,
            'soft' => false
        ];
    }
}
