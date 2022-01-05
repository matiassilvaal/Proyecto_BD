<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
    public function age_restriction()
    {
        return $this->belongsTo('App\Models\Age_restriction');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function game_genre()
    {
        return $this->hasMany('App\Models\Game_genre');
    }
    public function game_language()
    {
        return $this->hasMany('App\Models\Game_language');
    }
    public function library()
    {
        return $this->hasMany('App\Models\Library');
    }
    public function requirement()
    {
        return $this->belongsTo('App\Models\Requirement');
    }
    public function user_game()
    {
        return $this->hasMany('App\Models\User_game');
    }
    public function wish_game()
    {
        return $this->HasMany('App\Models\Wish_Game');
    }
}
