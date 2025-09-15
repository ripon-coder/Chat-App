@extends('layouts.app',["title"=>"Chat with ".($chats->isNotEmpty() ? optional($chats->first()->receiver_id == auth()->id() ? $chats->first()->sender : $chats->first()->receiver)->name : "User")])

@section('content')
    <div class="max-w-md mx-auto h-[500px] flex flex-col border border-gray-300 rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-100 border-b border-gray-300 overflow-fixed">
            <h2>{{optional($userInfo)->name}}</h2>
        </div>
        <!-- Chat Messages -->
        <div id="chatMessages" class="flex-1 p-4 space-y-4 overflow-y-auto bg-gray-50">
            @foreach ($chats as $chat)
                @if ($chat->receiver_id == auth()->id())
                    <div class="flex items-start gap-2.5">
                        <img class="w-8 h-8 rounded-full"
                            src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg"
                            alt="User avatar">
                        <div class="flex flex-col max-w-[320px] p-4 bg-gray-100 rounded-xl border border-gray-200">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-900">{{ optional($chat->sender)->name }}</span>
                                <span class="text-xs text-gray-500">- {{ $chat->created_at->format('H:i') }}</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-900">{{ $chat->message }}</p>
                            <span class="text-xs text-gray-500 mt-1">Delivered</span>
                        </div>
                    </div>
                @endif

                @if ($chat->sender_id == auth()->id())
                    <div class="flex items-start gap-2.5 justify-end">
                        <div
                            class="flex flex-col max-w-[320px] p-4 bg-blue-600 text-white rounded-xl border border-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold">You</span>
                                <span class="text-xs text-gray-200">- {{ $chat->created_at->format('H:i') }}</span>
                            </div>
                            <p class="mt-1 text-sm">{{ $chat->message }}</p>
                            <span class="text-xs text-gray-200 mt-1">Read</span>
                        </div>
                        <img class="w-8 h-8 rounded-full"
                            src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg"
                            alt="Your avatar">
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-4 border-t border-gray-300 bg-white flex gap-2">
            <input id="messageInput" type="text" placeholder="Type a message..."
                class="flex-1 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring focus:ring-blue-200">
            <button id="sendButton" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">Send</button>
        </div>
    </div>
@endsection

@section('scripts')
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const box = document.getElementById("chatMessages");
            if (box) {
                box.scrollTop = box.scrollHeight; // scroll to bottom
            }

            // Send message via AJAX
            $('#sendButton').click(function() {
                let message = $('#messageInput').val().trim();
                if (!message) return;

                $.ajax({
                    url: "{{ route('chat.send') }}",
                    method: "POST",
                    data: {
                        message: message,
                        userid: {{ $userId }},
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(chat) {
                        const box = document.getElementById("chatMessages");
                        box.insertAdjacentHTML('beforeend', `
                    <div class="flex items-start gap-2.5 justify-end">
                        <div class="flex flex-col max-w-[320px] p-4 bg-blue-600 text-white rounded-xl border border-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold">You</span>
                                <span class="text-xs text-gray-200">- ${chat.created_at}</span>
                            </div>
                            <p class="mt-1 text-sm">${chat.message}</p>
                            <span class="text-xs text-gray-200 mt-1">Read</span>
                        </div>
                        <img class="w-8 h-8 rounded-full" src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg" alt="Your avatar">
                    </div>
                `);
                        $('#messageInput').val('');
                        box.scrollTop = box.scrollHeight; // auto-scroll to bottom
                    }
                });
            });

            // Press Enter to send
            $('#messageInput').keypress(function(e) {
                if (e.which == 13) $('#sendButton').click();
            });

        });

        // Listen for live messages
        document.addEventListener('DOMContentLoaded', function() {
            let receiverId = {{ auth()->id() }};
            if (window.Echo) {
                window.Echo.private(`chat.${receiverId}`)
                    .listen('.message.sent', (data) => {
                        //console.log("🔥 rrr private message:", data.sender.name);
                        const box = document.getElementById("chatMessages");
                        // Incoming message (from other user)
                        box.insertAdjacentHTML('beforeend', `
                        <div class="flex items-start gap-2.5">
                            <img class="w-8 h-8 rounded-full" src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg" alt="User avatar">
                            <div class="flex flex-col max-w-[320px] p-4 bg-gray-100 rounded-xl border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-semibold">${data.sender.name}</span>
                                    <span class="text-xs text-gray-500">- ${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-900">${data.message}</p>
                                <span class="text-xs text-gray-500 mt-1">Delivered</span>
                            </div>
                        </div>
                    `);
                        box.scrollTop = box.scrollHeight; // auto-scroll
                    });
            } else {
                console.error("window.Echo is not defined yet!");
            }
        });
    </script>
@endsection
