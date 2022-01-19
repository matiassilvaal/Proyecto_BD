<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Requirement;
use App\Models\Address;
use App\Models\Age_restriction;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::factory(100)->create();
        \App\Models\Genre::factory(100)->create();
        \App\Models\Requirement::factory(100)->create();
        \App\Models\Age_restriction::factory(4)->create();
        \App\Models\Currency::factory(100)->create();
        \App\Models\Wallet::factory(100)->create();
        \App\Models\Role::factory(3)->create();
        \App\Models\Comment_type::factory(100)->create();
        \App\Models\Permission::factory(100)->create();
        \App\Models\Card::factory(100)->create();
        \App\Models\Method::factory(100)->create();
        \App\Models\Role_permission::factory(100)->create();
        \App\Models\Address::factory(100)->create();
        \App\Models\User::factory(100)->create();
        \App\Models\Invoice::factory(100)->create();
        \App\Models\User_method::factory(100)->create();
        \App\Models\Friend::factory(100)->create();
        $faker = Faker::create();
            foreach (range(1,100) as $index) {
            DB::table('games')->insert([
                'id_publisher' => User::all()->random()->id,
                'id_requisito' => Requirement::all()->random()->id,
                'id_ubicacion' => Address::all()->random()->id,
                'id_restriccion' => Age_restriction::all()->random()->id,
                'nombre' => $faker->streetName,
                'precio' => $faker->numberBetween($min = 5, $max = 100),
                /**
                 * Tenía argumentos en el ejemplo,
                 * no los puse
                 */
                'fecha_de_lanzamiento' => $faker->date($format = 'Y-m-d'),
                /**
                 * Saqué segundo argumento
                 */
                'descuento' => $faker->numberBetween($min = 1, $max = 100),
                'imagen' => 'https://source.unsplash.com/random/200x200?sig='.$index,
                'descripcion' => $faker->realText($maxNbChars = 200),
                'descarga' => $faker->url,
                'demo' => $faker->url,
                'soft' => false
            ]);
        }
        \App\Models\Game_language::factory(100)->create();
        \App\Models\Game_genre::factory(100)->create();
        \App\Models\Comment::factory(100)->create();
        \App\Models\User_game::factory(100)->create();
        \App\Models\Wish_game::factory(100)->create();
        \App\Models\Library::factory(100)->create();
        \App\Models\Purchase::factory(100)->create();
        // \App\Models\User::factory(10)->create();
    }
}