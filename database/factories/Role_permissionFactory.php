<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class Role_permissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_rol' => Role::all()->random()->id,
            'id_permiso' => Permission::all()->random()->id,
            'soft' => false
        ];
    }
}
