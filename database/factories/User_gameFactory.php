<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_gameFactory extends Factory
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
            'like' => $this->faker->boolean,
            'valoracion' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10)
        ];
    }
}
