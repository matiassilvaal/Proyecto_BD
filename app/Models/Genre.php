<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function game_genre()
    {
        return $this->hasMany('App\Models\Game_genre');
    }
}
