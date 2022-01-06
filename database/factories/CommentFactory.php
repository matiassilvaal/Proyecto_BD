<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_juego' => Game::all()->random()->id,
            'id_usuario' => User::all()->random()->id,
            'texto' => $this->faker->realText($maxNbChars = 1000)
            /**
             * Le quité el segundo parámetro
             * que era $indexSize
             */,
            'fecha_de_creacion' => $this->faker->dateTime($max = 'now')
            /**
             * Le quité el segundo parámetro
             * que era $timezone
             */
        ];
    }
}
