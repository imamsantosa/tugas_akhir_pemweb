<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository implements BaseRepository {

    public function index() {
        return Comment::with('user', 'post')->get();
    }

    public function create($new = []) {
        $new_comment = new Comment();
        $new_comment->post_id = $new['post_id'];
        $new_comment->user_id = $new['user_id'];
        $new_comment->comment = $new['comment'];

        if($new_comment->save()) {
            return response()->json([
                'status' => 'success',
                'detail' => 'Comment created successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Error saving comment'
            ]);
        }
    }

    public function view($id) {
        $result = Comment::find($id);
        if ($result != null) {
            return $result;
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Comment not found'
            ]);
        }
    }

    public function update($id, $data = []) {
        $result = Comment::find($id);
        $result->comment = $data['comment'];

        if($result->save()) {
            return response()->json([
                'status' => 'success',
                'detail' => 'Comment updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Error update comment'
            ]);
        }
    }

    public function delete($id) {
        $result = Comment::find($id);
        if ($result != null) {
            $result->delete();

            return response()->json([
                'status' => 'success',
                'detail' => 'Comment deleted'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Comment not found'
            ]);
        }
    }


}