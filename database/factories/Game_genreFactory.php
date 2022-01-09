<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class Game_genreFactory extends Factory
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
            'id_genero' => Genre::all()->random()->id,
            'soft' => false
        ];
    }
}
