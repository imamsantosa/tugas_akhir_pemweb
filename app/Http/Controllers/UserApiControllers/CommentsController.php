<?php

namespace App\Http\Controllers\UserApiControllers;

use App\Repositories\UserApi\CommentsRepository;

class CommentsController extends BaseController
{
    protected $repository;

    public function __construct(CommentsRepository $repo)
    {
        $this->repository = $repo;
    }

    public function create()
    {
        return $this->respondSuccess($this->repository->create());
    }

    public function delete()
    {
        return $this->respondSuccess($this->repository->delete());
    }

    public function list()
    {
        return $this->respond($this->repository->list());
    }

}
