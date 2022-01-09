<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class Game_languageFactory extends Factory
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
            'id_idioma' => Language::all()->random()->id,
            'soft' => false
        ];
    }
}
