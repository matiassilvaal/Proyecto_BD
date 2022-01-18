<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    //use SoftDeletes;
    use HasFactory;

    public function game()
    {
        return $this->hasMany('App\Models\Game');
    }
    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
