<?php
/**
 * Created by PhpStorm.
 * User: ridho
 * Date: 5/20/16
 * Time: 22:29
 */

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;

class MessageController extends Controller {

    private $user, $message;

    public function __construct(User $user, Message $message) {
        $this->user = $user;
        $this->message = $message;
    }

    public function index($username) {
        if (auth()->user()->username != $username) {
            return $this->conversations($username);
        } else {
            return redirect()->route('user-home');
        }
    }

    private function conversations($username) {
        $recipient = $this->user->where('username', $username)->first();
        $result = $this->message->where([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $recipient->id
        ])->orWhere([
            'sender_id' => $recipient->id,
            'recipient_id' => auth()->user()->id
        ])->get();

        $messages = $result->map(function ($message) {
            return [
                'message_id' => $message->id,
                'sender_id' => $message->sender_id,
                'sender_username' => $this->user->find($message->sender_id)->username,
                'sender_name' => $this->user->find($message->sender_id)->full_name,
                'recipient_id' => $message->recipient_id,
                'recipient_username' => $this->user->find($message->recipient_id)->username,
                'recipient_name' => $this->user->find($message->recipient_id)->full_name,
                'message' => $message->message,
                'sent_at' => $message->created_at
            ];
        });

        return View('user/conversations', [
            'messages' => $messages,
            'recipient_id' => $recipient->id,
        ]);
    }

    public function listConversation() {
        $result = $this->message->where('sender_id', auth()->user()->id)
            ->orWhere('recipient_id', auth()->user()->id)
            ->get();

        $lists = $result->map(function ($list) {
            if ($list->sender_id == auth()->user()->id) {
                return [
                    'my_id' => auth()->user()->id,
                    'friend_id' => $this->user->find($list->recipient_id)->id,
                    'friend_username' => $this->user->find($list->recipient_id)->username,
                    'friend_name' => $this->user->find($list->recipient_id)->full_name,
                ];
            } else {
                return [
                    'my_id' => auth()->user()->id,
                    'friend_id' => $this->user->find($list->sender_id)->id,
                    'friend_username' => $this->user->find($list->sender_id)->username,
                    'friend_name' => $this->user->find($list->sender_id)->full_name,
                ];
            }
        });

        return $lists->unique('friend_username');
    }

}