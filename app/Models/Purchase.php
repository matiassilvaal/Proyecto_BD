<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
}
