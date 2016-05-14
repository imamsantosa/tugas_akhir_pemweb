<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App/User;

class Message extends Model
{

    protected $table = "messages";

    protected $fillable = [
    	'sender_id',
    	'recipient_id',
    	'message'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function recipient() 
    {
    	return $this->belongsTo(User::class);
    }
}
