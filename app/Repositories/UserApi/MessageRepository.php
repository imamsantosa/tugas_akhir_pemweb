<?php
/**
 * Created by PhpStorm.
 * User: ridho
 * Date: 5/20/16
 * Time: 21:01
 */

namespace App\Repositories\UserApi;
use App\Message;
use Illuminate\Http\Request;

class MessageRepository {

    private $request, $message;

    public function __construct(Request $request, Message $message) {
        $this->request = $request;
        $this->message = $message;
    }

    public function sendMessage() {
        $newMessage = new Message();

        $newMessage->sender_id = auth()->user()->id;
        $newMessage->recipient_id = $this->request->input('recipient_id');
        $newMessage->message = $this->request->input('message');
        $newMessage->save();

        return ['error' => false, 'message' => 'sukses kirim pesan'];
    }

    public function deleteConversation() {
        $result = $this->message->where([
            'sender_id' => auth()->user()->id,
            'recipient_id' => $this->request->input('recipient_id')
        ])->orWhere([
            'sender_id' => $this->request->input('recipient_id'),
            'recipient_id' => auth()->user()->id
        ])->delete();

        return ['error' => false, 'message' => 'sukses hapus percakapan'];
    }

}