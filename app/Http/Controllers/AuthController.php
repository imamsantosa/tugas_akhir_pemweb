<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController {

    private $repo;

    public function __construct(AuthRepository $repo) {
        $this->repo = $repo;
    }

    public function register()
    {
        return $this->respondSuccess($this->repo->register());
    }
    
    public function login()
    {
        return $this->respond($this->repo->login());
    }
}
