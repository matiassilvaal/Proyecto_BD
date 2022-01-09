<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_usuario1' => User::all()->random()->id,
            'id_usuario2' => User::all()->random()->id,
            'soft' => false
        ];
    }
}
