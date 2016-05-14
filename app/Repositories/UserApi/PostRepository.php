<?php

namespace App\Repositories\UserApi;

use App\Post;
use App\Friendship;

class PostRepository {

    private $request;
    private $post;
    private $friend;

    public function __construct(Request $request, Post $post, Friendship $friend)
    {
        $this->friend  = $friend;
        $this->post    = $post;
        $this->request = $request;
    }


    public function create() 
    {
        $new_status = $this->post->create([
            'user_id' => auth()->user()->id,
            'caption' => $this->request->input('caption')
        ]);

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
        })

        return $response;
    }

}