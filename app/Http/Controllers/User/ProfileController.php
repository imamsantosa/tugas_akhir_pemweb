<?php
/**
 * Created by PhpStorm.
 * User: imamsantosa
 * Date: 5/18/16
 * Time: 17:25
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\ProfileRepository;

class ProfileController extends Controller
{

    private $repository;

    public function __construct(ProfileRepository $repository) {
        $this->repository = $repository;
    }

    public function index(Request $request, $username)
    {
        if(auth()->user()->username == $username)
            return $this->self();
        else
            return $this->profile($username);
    }

    private function self()
    {
        $posts = $this->repository->posts(auth()->user());
        $postCount = $this->repository->countPost(auth()->user());
        $followerCount = $this->repository->countFollower(auth()->user());
        $followingCount = $this->repository->countFollowing(auth()->user());

        return View('user/profile_self', [
            'post_count' => $postCount,
            'follower_count' => $followerCount,
            'following_count' => $followingCount,
            'posts' => $posts
        ]);
    }

    private function profile($username)
    {
        $data = $this->repository->profile($username);
        $isFollowed = $this->repository->isFollowed($username);
        $postCount = $this->repository->countPost($data);
        $followerCount = $this->repository->countFollower($data);
        $followingCount = $this->repository->countFollowing($data);
        $posts = $this->repository->posts(auth()->user());

        return View('user/profile_someone', [
            'user_data' => $data,
            'post_count' => $postCount,
            'follower_count' => $followerCount,
            'following_count' => $followingCount,
            'is_followed' => $isFollowed,
            'posts' => $posts
        ]);
    }
}