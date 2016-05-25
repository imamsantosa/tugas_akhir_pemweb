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

    public function index($username) {
        if (auth()->user()->username != $username) {
            return $this->conversations($username);
        } else {
            return redirect()->route('user-home');
        }
    }

    private function conversations($username) {
        $recipient = User::where('username', $username)->first();
        $result = Message::where([
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
                'sender_username' => User::find($message->sender_id)->username,
                'sender_name' => User::find($message->sender_id)->full_name,
                'recipient_id' => $message->recipient_id,
                'recipient_username' => User::find($message->recipient_id)->username,
                'recipient_name' => User::find($message->recipient_id)->full_name,
                'message' => $message->message,
                'sent_at' => $message->created_at
            ];
        });

        return View('user/conversations', [
            'messages' => $messages,
            'recipient_id' => $recipient->id,
        ]);
        //return ['messages'=>$messages];
    }

}