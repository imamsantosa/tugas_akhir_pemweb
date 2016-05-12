<?php

namespace App\Repositories;

use App\User;

class UserRepository implements BaseRepository {

    public function index() {
        return User::all();
    }

    public function create($data = []) {
        if (User::where('username', $data['username'])->first() == null) {
            $new_user = new User();

            $new_user->username = $data['username'];
            $new_user->email = $data['email'];
            $new_user->password = $data['password'];
            $new_user->full_name = $data['full_name'];
            $new_user->birthdate = $data['birthdate'];

            $new_user->save();

            return response()->json([
                'status' => 'success',
                'detail' => 'User saved'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Username already registered'
            ]);
        }
    }

    public function view($id) {
        $result = User::find($id);
        if ($result != null) {
            return $result;
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'User not found'
            ]);
        }
    }

    public function update($id, $data = []) {
        $result = User::find($id);
        if (User::where('username', $data['username'])->first() == null) {

            $result->username = $data['username'];
            $result->email = $data['email'];
            $result->password = $data['password'];
            $result->full_name = $data['full_name'];
            $result->birthdate = $data['birthdate'];
            $result->status_message = $data['status_message'];

            $result->save();

            return response()->json([
                'status' => 'success',
                'detail' => 'User updated'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'Username already registered'
            ]);
        }
    }

    public function delete($id) {
        $result = User::find($id);
        if ($result != null) {
            $result->delete();

            return response()->json([
                'status' => 'success',
                'detail' => 'User deleted'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'detail' => 'User not found'
            ]);
        }
    }

}