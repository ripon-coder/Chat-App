@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto h-[500px] flex flex-col border border-gray-300 rounded-xl overflow-hidden">

        <!-- Chat Messages -->
        <div id="chatMessages" class="flex-1 p-4 space-y-4 overflow-y-auto bg-gray-50">
            @foreach ($chats as $chat)
                @if ($chat->receiver_id == auth()->id())
                    <div class="flex items-start gap-2.5">
                        <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/40?img=3" alt="User avatar">
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
                        <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/40?img=5" alt="Your avatar">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

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
                        $('#chatMessages').append(`
                    <div class="flex items-start gap-2.5 justify-end">
                        <div class="flex flex-col max-w-[320px] p-4 bg-blue-600 text-white rounded-xl border border-blue-500">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold">You</span>
                                <span class="text-xs text-gray-200">- ${chat.created_at}</span>
                            </div>
                            <p class="mt-1 text-sm">${chat.message}</p>
                            <span class="text-xs text-gray-200 mt-1">Read</span>
                        </div>
                        <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/40?img=5" alt="Your avatar">
                    </div>
                `);

                        $('#messageInput').val('');
                        $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
                    }
                });
            });

            $('#messageInput').keypress(function(e) {
                if (e.which == 13) $('#sendButton').click();
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let receiverId = document.getElementById('receiverId').value;

            if (window.Echo) {
                window.Echo.private(`chat.${receiverId}`)
                    .listen('.message.sent', (data) => {
                        console.log("🔥 Live private message:", data);
                        const box = document.getElementById("chatMessages");
                        box.innerHTML += `
                    <div class="flex items-start gap-2.5">
                        <img class="w-8 h-8 rounded-full" src="https://i.pravatar.cc/40?img=3" alt="User avatar">
                        <div class="flex flex-col max-w-[320px] p-4 bg-gray-100 rounded-xl border border-gray-200">
                            <p>${data.message}</p>
                        </div>
                    </div>
                `;
                        box.scrollTop = box.scrollHeight; // auto-scroll to bottom
                    });
            } else {
                console.error("window.Echo is not defined yet!");
            }
        });
    </script>
@endsection
