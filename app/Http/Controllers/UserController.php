<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        return $this->repository->index();
    }

    public function create(Request $request) {
        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'full_name' => $request->input('full_name'),
            'birthdate' => $request->input('birthdate')
        ];

        return $this->repository->create($data);
    }

    public function view($id) {
        return $this->repository->view($id);
    }

    public function update(Request $request, $id) {
        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'full_name' => $request->input('full_name'),
            'birthdate' => $request->input('birthdate'),
            'status_message' => $request->input('status_message'),
        ];

        return $this->repository->update($id, $data);
    }

    public function delete($id) {
        return $this->repository->delete($id);
    }

}
