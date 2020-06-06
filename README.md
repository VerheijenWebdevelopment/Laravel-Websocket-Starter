<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel Websocket Starter

This is a skeleton Laravel 7 application with some modifications and pre-installed packages to get you started quickly on your next Laravel application that has to use websockets.

Since I usually develop on Windows using Homestead this scaffold and it's instructions will reflect that. Keep that in mind if using this in a different environment.

## Features & modifications

- [x] Dedicated models directory under `app\Models`
- [x] Moved `app/User.php` model to `app/Models/User.php`
- [x] Webpack.mix.js is configured for live-reloading
- [x] Basic authentication
- [x] Landing page with basic chatbox
- [x] Pre-installed [beyondcode/laravel-websockets](https://github.com/beyondcode/laravel-websockets)
- [x] Pre-installed [pusher/pusher-php-server]()
- [x] Pre-installed [laravel/horizon](https://github.com/laravel/horizon)
- [x] Pre-installed `vue`, `axios`, `vue-axios`, `pusher-js`,  `laravel-echo`

## Installation

1. Clone the repository using the following command:
```
git clone git@github.com:VerheijenWebdevelopment/Laravel-Websocket-Starter.git MyApplication
```

2. Install dependencies
```
composer install
```

2. Install frontend dependencies
```
npm install
```

3. Run npm watch to compile assets & launch the application:
```
npm run watch
```

4. (Create and) update your `.env` environment file, set the following values. Empty values you should update yourself.
```
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=starter
PUSHER_APP_KEY=aaaaaaaaaaaaaaaaaaaa
PUSHER_APP_SECRET=aaaaaaaaaaaaaaaaaaaa
PUSHER_APP_CLUSTER=eu

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

WEBSOCKET_HOST_WS=laravel-websocket-starter.test
WEBSOCKET_PORT_WS=6001
WEBSOCKET_PORT_WSS=6001
WEBSOCKET_ENCRYPTED=false
WEBSOCKET_USE_TLS=false
WEBSOCKET_SCHEME=http

WEBSOCKET_BROADCAST_HOST=192.168.10.10
WEBSOCKET_BROADCAST_PORT=6001

MIX_WEBSOCKET_PORT="${WEBSOCKET_PORT}"
MIX_WEBSOCKET_ENCRYPTED="${WEBSOCKET_ENCRYPTED}"
MIX_WEBSOCKET_PORT_WS="${WEBSOCKET_PORT_WS}"
MIX_WEBSOCKET_PORT_WSS="${WEBSOCKET_PORT_WSS}"
MIX_WEBSOCKET_USE_TLS="${WEBSOCKET_USE_TLS}"
```

5. Run migrations (not actually required but why not)
```
php artisan migrate
```

6. Update homestead `/etc/nginx/sites-available/laravel-websocket-starter.test` config file and add:
```
location /ws {
    proxy_pass             http://192.168.10.10:6001;
    proxy_set_header Host  $host;
    proxy_read_timeout     60;
    proxy_connect_timeout  60;
    proxy_redirect         off;

    # Allow the use of websockets
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection 'upgrade';
    proxy_set_header Host $host;
    proxy_cache_bypass $http_upgrade;
}
```

7. Start websocket server by ssh-ing into the homestead vm and executing:
```
php artisan websockets:serve --host=192.168.10.10
```

8. Should be done.

#### TODO: test procedure & update instructions