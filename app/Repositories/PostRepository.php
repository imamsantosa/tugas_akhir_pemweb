<?php

namespace App\Repositories;

use App\Post;

class PostRepository implements BaseRepository {

    public function index() {
        return Post::with('user','comments')->get();
    }

    public function create($new = []) {
        $new_post = new Post();
        $new_post->user_id = $new['user_id'];
        $new_post->caption = $new['caption'];

        if ($new_post->save()) {
            return response()->json([
                'status' => 'success',
                'detail' => 'Post created successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Unable to save post'
            ]);
        }
    }

    public function view($id) {
        $result = Post::with('user', 'comments')->find($id);
        if ($result != null) {
            return $result;
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Post not found'
            ]);
        }
    }

    public function update($id, $data = []) {
        $result = Post::find($id);
        $result->caption = $data['caption'];

        if ($result->save()) {
            return response()->json([
                'status' => 'success',
                'detail' => 'Post updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Unable to save post'
            ]);
        }
    }

    public function delete($id) {
        $result = Post::find($id);
        if ($result != null) {
            $result->delete();

            return response()->json([
                'status' => 'success',
                'detail' => 'Post deleted'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Post not found'
            ]);
        }
    }


}