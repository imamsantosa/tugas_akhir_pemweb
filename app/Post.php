<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;

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

    public function commentCount()
    {
        return Comment::where('post_id', $this->id)->count();
    }

    public function Comments()
    {
    	$comments = Comment::where('post_id', $this->id)
    				->get();

    	$recent = $comments->map(function($comment){
            return [
                'username' => $comment->user->username,
                'full_name' => $comment->user->fullname,
                'comment' => $comment->comment
            ];
    	});

    	return $recent;
    }

    public function likeCount()
    {
        return Like::where('post_id', $this->id)->count();
    }

    public function isLiked()
    {
        return Like::where('post_id', $this->id)->where('user_id', auth()->user()->id)->count() >= 1;
    }

}
