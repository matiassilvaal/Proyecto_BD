<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_method extends Model
{
    use HasFactory;

    public function method()
    {
        return $this->belongsTo('App\Models\Method');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
