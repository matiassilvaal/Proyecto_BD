<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    public function card()
    {
        return $this->belongsTo('App\Models\Card');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
    public function user_method()
    {
        return $this->hasMany('App\Models\User_method');
    }

}
