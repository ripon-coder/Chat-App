<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $chatService;
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }
    public function index(Request $request)
    {
        if ($request->userid == auth()->id()) {
            return redirect()->route('user.index');
        }
        $data["chats"] = $this->chatService->chat(auth()->id(), $request->userid);
        $data["userId"] = $request->userid;
        return view('chat', $data);
    }

    public function send(Request $request)
    {
        $chat = $this->chatService->send(auth()->id(), $request->userid);
        return response()->json([
            'message' => $chat->message,
            'created_at' => $chat->created_at->format('H:i'),
        ]);
    }
}
