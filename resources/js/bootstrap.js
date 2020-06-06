window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');
let useTLSOverride = process.env.MIX_WEBSOCKET_USE_TLS === "true" ? true : false;
if (useTLSOverride) {
    window.Pusher.Runtime.getProtocol = function () {
        return "http:";
    }
}

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    // wsHost: window.location.hostname,
    wsHost: 'laravel-websocket-starter.test',
    wsPort: process.env.MIX_WEBSOCKET_PORT_WS,
    wssPort: process.env.MIX_WEBSOCKET_PORT_WSS,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: false,
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});
