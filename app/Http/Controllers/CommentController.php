<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller {

    public function __construct(CommentRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }

    public function view($id) {
        return $this->repository->view($id);
    }

    public function create(Request $request) {
        $data = [
            'post_id' => $request->input('post_id'),
            'user_id' => $request->input('user_id'),
            'comment' => $request->input('comment')
        ];

        return $this->repository->create($data);
    }

    public function update(Request $request, $id) {
        $data = [
            'comment' => $request->input('comment')
        ];

        return $this->repository->update($data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

}
