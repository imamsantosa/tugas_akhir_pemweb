<?php

namespace App\Repositories\UserApi;

use App\Like;
use App\Post;
use App\Friendship;

class PostRepository {

    private $request;
    private $post;
    private $like;
    private $friend;

    public function __construct(Request $request, Post $post, Friendship $friend, Like $like)
    {
        $this->friend  = $friend;
        $this->post    = $post;
        $this->like = $like;
        $this->request = $request;
    }


    public function create() 
    {
        $new_status = $this->post->create([
            'user_id' => auth()->user()->id,
            'caption' => $this->request->input('caption')
        ]);``

        return "Sukses Menambahkan Status";
    }

    public function delete() 
    {
        $delete = $this->post->find($this->request->input('post_id'));
        $delete->delete();

        return "Sukses menghapus post";
    }

    public function list() 
    {
        $friend = $this->friend
                        ->where('user_id', auth()->user()->id)
                        ->get(['friend_id']);

        $result = $this->post
                        ->whereIn('user_id', $friend)
                        =>get();

        $response = [];
        $response['data'] = $result->map(function($post){
            'post_id' => $post->id,
            'username' => $post->user->username,
            'full_name' => $post->user->fullname,
            'caption' => $post->caption,
            'comment_count' => $post->countComment(),
            'recent_comment' => $post->recentComment()
        });

        return $response;
    }

    public function like()
    {
        $post_id = $this->request->input('post_id');
        $newLike = $this->like->create([
            'post_id' => $post_id,
            'user_id' => auth()->user()->id
        ]);
        
        $post = $this->post->find($post_id);
        return ['error' => false, 'message' => 'sukses menambahkan like', 'count_like' => $post->like_count()];
    }

    public function unlike()
    {
        $post_id = $this->request->input('post_id');

        $liked = $this->like->where('user_id', auth()->user()->id)->where('post_id', $post_id)->firstOrFail();
        $liked->delete();

        $post = $this->post->find($post_id);
        return ['error' => false, 'message' => 'sukses menghapus like', 'count_like' => $post->like_count()];
    }
}