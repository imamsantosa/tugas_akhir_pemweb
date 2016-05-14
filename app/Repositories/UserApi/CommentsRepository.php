<?php

namespace App\Repositories\UserApi;

use App\Comment;

class CommentRepository {

    private $request;
    private $comment;

    public function __construct(Request $request, Comment $comment)
    {
        $this->comment = $comment;
        $this->request = $request;
    }


    public function create() 
    {
        $new_comment = $this->comment->create([
            'post_id' => $this->request->input('post_id'),
            'user_id' => $this->request->input('user_id'),
            'comment' => $this->request->input('comment')
        ]);

        return "Sukses menambahkan komentar";
    }

    public function delete() 
    {
        $delete = $this->comment->find($this->request->input('comment_id'));
        $delete->delete();

        return "Sukses menghapus komentar";
    }

    public function list() 
    {
        $result = $this->comment
                        ->where('post_id', $this->request->input('post_id'))
                        =>get();

        $response = [];
        $response['data'] = $result->map(function($comment){
            'username' => $comment->user->username,
            'full_name' => $comment->user->fullname,
            'comment' => $comment->comment
        })

        return $response;
    }

}