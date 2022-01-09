<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Method;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_methodFactory extends Factory
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
            'id_tarjeta' => Method::all()->random()->id,
            'soft' => false
        ];
    }
}
