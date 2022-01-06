<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
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
            'id_boleta' => Invoice::all()->random()->id
        ];
    }
}
