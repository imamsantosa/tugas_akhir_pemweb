<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $table = "reports";

    public function post() {
        return $this->belongsTo('App\Post');
    }

    public function reporter() {
        return $this->belongsTo('App\User');
    }

}
