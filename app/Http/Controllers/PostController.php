<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostController extends Controller {

    public function __construct(PostRepository $repository) {
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
            'user_id' => $request->input('user_id'),
            'caption' => $request->input('caption')
        ];

        return $this->repository->create($data);
    }

    public function update(Request $request, $id) {
        $data = [
            'caption' => $request->input('caption')
        ];

        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

}
