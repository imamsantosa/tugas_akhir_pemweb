<?php
/**
 * Created by PhpStorm.
 * User: ridho
 * Date: 5/20/16
 * Time: 21:23
 */

namespace App\Http\Controllers\UserApi;
use App\Repositories\UserApi\MessageRepository;

class MessageController extends BaseController {

    private $messageRepository;

    public function __construct(MessageRepository $mr) {
        $this->messageRepository = $mr;
    }

    public function sendMessage() {
        return $this->respond($this->messageRepository->sendMessage());
    }

    public function deleteConversation() {
        return $this->respond($this->messageRepository->deleteConversation());
    }

}