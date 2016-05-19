<?php
/**
 * Created by PhpStorm.
 * User: imamsantosa
 * Date: 5/18/16
 * Time: 17:25
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\UserApi\FriendshipRepository;
use Illuminate\Http\Request;
use App\Repositories\User\ProfileRepository;

class ProfileController extends Controller
{

    private $profileRepository, $friendshipRepository;

    public function __construct(ProfileRepository $profileRepository, FriendshipRepository $friendshipRepository) {
        $this->profileRepository = $profileRepository;
        $this->friendshipRepository = $friendshipRepository;

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
        $posts = $this->profileRepository->posts(auth()->user());
        $postCount = $this->profileRepository->countPost(auth()->user());
        $followerCount = $this->friendshipRepository->countFollower(auth()->user()->id);
        $followingCount = $this->friendshipRepository->countFollowing(auth()->user()->id);

        return View('user/profile_self', [
            'post_count' => $postCount,
            'follower_count' => $followerCount,
            'following_count' => $followingCount,
            'posts' => $posts
        ]);
    }

    private function profile($username)
    {
        $data = $this->profileRepository->profile($username);
        $isFollowed = $this->profileRepository->isFollowed($username);
        $postCount = $this->profileRepository->countPost($data);
        $followerCount = $this->friendshipRepository->countFollower($data->id);
        $followingCount = $this->friendshipRepository->countFollowing($data->id);
        $posts = $this->profileRepository->posts(auth()->user());

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