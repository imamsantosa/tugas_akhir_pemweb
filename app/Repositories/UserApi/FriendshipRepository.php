<?php
/**
 * Created by PhpStorm.
 * User: ridho
 * Date: 5/19/16
 * Time: 12:52
 */

namespace App\Repositories\UserApi;
use App\Friendship;
use Illuminate\Http\Request;

class FriendshipRepository {

    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function follow() {
        $findResult = Friendship::where([
            'user_id' => auth()->user()->id,
            'friend_id' => $this->request->input('friend_id')
        ])->first();

        if ($findResult == null) {
            $newFollow = new Friendship();
            $newFollow->user_id = auth()->user()->id;
            $newFollow->friend_id = $this->request->input('friend_id');

            $newFollow->save();

            return ['error' => false, 'message' => 'berhasil follow'];
        } else {
            return ['error' => true, 'message' => 'gagal follow'];
        }
    }

    public function unfollow() {
        $findResult = Friendship::where([
            'user_id' => auth()->user()->id,
            'friend_id' => $this->request->input('friend_id')
        ])->first();

        if ($findResult != null) {
            $findResult->delete();

            return ['error' => false, 'message' => 'berhasil unfollow'];
        } else {
            return ['error' => true, 'message' => 'gagal unfollow'];
        }
    }

}