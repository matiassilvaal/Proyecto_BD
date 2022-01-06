<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

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
        \App\Models\Age_restriction::factory(100)->create();
        \App\Models\Currency::factory(100)->create();
        \App\Models\Wallet::factory(100)->create();
        \App\Models\Country::factory(100)->create();
        \App\Models\Role::factory(100)->create();
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
        \App\Models\Game::factory(100)->create();
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