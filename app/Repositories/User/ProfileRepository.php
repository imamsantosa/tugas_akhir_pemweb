<?php
/**
 * Created by PhpStorm.
 * User: ridho
 * Date: 5/19/16
 * Time: 11:32
 */

namespace App\Repositories\User;
use App\User;
use App\Post;
use App\Friendship;

class ProfileRepository {

    public function profile($username) {
        return User::where('username', $username)->first();
    }

    public function countPost($user) {
        return Post::where('user_id', $user->id)->get()->count();
    }

    public function isFollowed($username) {
        $result = $this->profile($username);
        $criteria = [
            'user_id' => auth()->user()->id,
            'friend_id' => $result->id
        ];

        if (Friendship::where($criteria)->first() != null) {
            return true;
        } else {
            return false;
        }
    }

    public function posts($user) {
        $result = Post::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $posts= $result->map(function($post){
            return [
                'post_id' => $post->id,
                'username' => $post->user->username,
                'full_name' => $post->user->full_name,
                'avatar' => $post->user->avatar,
                'caption' => $post->caption,
                'isLiked' => $post->isLiked(),
                'likeCount' => $post->likeCount(),
                'commentCount' => $post->commentCount(),
                'created_at' => $post->created_at(),
                'datetime' => $post->created_at->toDateTimeString(),
                'comments' => $post->comments()
            ];
        });

        return $posts;
    }

}