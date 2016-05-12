<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{

    protected $table = "friendships";

    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
