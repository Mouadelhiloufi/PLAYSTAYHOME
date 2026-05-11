import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

const reverbHost = import.meta.env.VITE_REVERB_HOST;
const reverbPort = Number(import.meta.env.VITE_REVERB_PORT ?? 443);
const reverbScheme = import.meta.env.VITE_REVERB_SCHEME ?? 'https';

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: reverbHost,
    wsPort: reverbPort,
    wssPort: reverbPort,
    forceTLS: reverbScheme === 'https',
    enabledTransports: ['ws', 'wss'],
    cluster: '',
    csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),

     auth: {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token'),
            Accept: 'application/json'
        }
    }
});
