import Echo from "laravel-echo";
import Pusher from "pusher-js";
window.Pusher = Pusher;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').getAttribute('content');



window.Echo = new Echo({
    broadcaster: "reverb", // use Reverb, not Pusher
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"], // important for websocket
});

// window.Echo.private(`chat.5`)
//     .listen('.message.sent', (data) => {
//         console.log("🔥 Live private message:", data);
//     });