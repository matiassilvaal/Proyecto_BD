<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }
    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }
    public function friend1()
    {
        return $this->hasMany('App\Models\Friend');
    }
    public function friend2()
    {
        return $this->hasMany('App\Models\Friend');
    }
    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice');
    }
    public function library()
    {
        return $this->hasMany('App\Models\Library');
    }
    public function user_game()
    {
        return $this->hasMany('App\Models\User_game');
    }
    public function user_method()
    {
        return $this->hasMany('App\Models\User_method');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }
    public function wish_game()
    {
        return $this->hasMany('App\Models\Wish_game');
    }
}
