<?php

namespace App\Services;

use App\Events\MessageSentEvent;
use App\Repositories\Contracts\ChatRepositoryContract;

class ChatService
{
    protected ChatRepositoryContract $chatRepository;

    public function __construct(ChatRepositoryContract $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function chat($authId, $userId)
    {
        return $this->chatRepository->chat($authId, $userId);
    }

    public function send($authId, $userId)
    {
        broadcast(new MessageSentEvent($authId, $userId, request()->message, auth()->user()->name))->toOthers();

        return $this->chatRepository->send($authId, $userId);
    }
}
