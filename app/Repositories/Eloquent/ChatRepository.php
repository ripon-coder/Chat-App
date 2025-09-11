<?php
namespace App\Repositories\Eloquent;

use App\Models\Chat;
use App\Repositories\Contracts\ChatRepositoryContract;
class ChatRepository implements ChatRepositoryContract
{
    public function chat($authId, $userId)
    {
        return Chat::with(['sender'])->where(function ($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $userId)
                    ->where('receiver_id', $authId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function send($authId, $userId)
    {
        return Chat::create([
            'sender_id' => $authId,
            'receiver_id' => $userId,
            'message' => request()->message,
        ]);
    }
}