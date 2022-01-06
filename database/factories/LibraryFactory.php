<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryFactory extends Factory
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
            'horas_jugadas' => $this->faker->numberBetween($min = 0, $max = NULL)
        ];
    }
}
