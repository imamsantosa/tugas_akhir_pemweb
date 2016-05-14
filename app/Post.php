<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App/Comment;
use App/User;

class Post extends Model
{

    protected $table = "posts";

    protected $fillable = [
        'user_id',
        'caption'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function countComment()
    {
        return Comment::where('post_id', $this->id)->count();
    }

    public function recentComment()
    {
    	$comments = Comment::where('post_id', $this->id)
    				->skip($this->countComment() - 4)
    				->get();
    	$recent = $comments->map(function($comment){
    		'username' => $comment->user->username,
            'full_name' => $comment->user->fullname,
            'comment' => $comment->comment
    	});

    	return $recent;
    }

}
