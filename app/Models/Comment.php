<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function comment_type()
    {
        return $this->belongsTo('App\Models\Comment_type');
    }
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
