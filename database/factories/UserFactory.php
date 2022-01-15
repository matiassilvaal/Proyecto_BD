<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Role;
use App\Models\Currency;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_direccion' => Address::all()->random()->id,
            'id_rol' => Role::all()->random()->id,
            'id_moneda' => Currency::all()->random()->id,
            'id_billetera' => Wallet::all()->random()->id,
            'nombre' => $this->faker->unique()->userName,
            'fecha_de_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'moneda' => $this->faker->numberBetween($min = 0, $max = NULL),
            /**
             * Que es moneda?
             * Porque en el modelo de wallet hay un cantidad
             * Pero aqui hay un moneda y no se que es
             */
            'email' => $this->faker->email,
            
            'password' => Hash::make($this->faker->password),
            'soft' => false
        ];
    }
}
