<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Laravel Websocket Starter

This is a skeleton Laravel 7 application with some modifications and the [beyondcode/laravel-websockets](#) package pre-installed to get you started quickly on your next Laravel application.

Since I usually develop on Windows using Homestead this scaffold and it's instructions will reflect that. Keep that in mind if using this in a different environment.

## Features

The following changes were made, in order, to a default Laravel installation:

- [x] Created designated `app/Models` directory
- [x] Moved `app/User.php` model to `app/Models/User.php`
- [x] Updated `config/auth.php` to load the user model from it's new location
- [x] Updated `config/app.php` to load the `BroadcastingServiceProvider`
- [x] Updated `webpack.mix.js` so we have asset compiling & live reloading when we run `npm run watch`
- [x] Moved inline styling to `resources/sass/app.scss`
- [x] Created default layout called `resources/views/layouts/app.blade.php`
- [x] Added csrf token meta tag to `layout.blade.php`
- [x] Created landing page view called `resources/views/pages/landing.blade.php`
- [x] Moved contents of `welcome.blade.php` to `landing.blade.php` and deleted `welcome.blade.php`
- [x] Created a `App\Http\Controllers\LandingController.php` controller
- [x] Updated `routes/web.php` route file so landing page route points to the `LandingController`
- [x] Installed the [beyondcode/laravel-websockets](#) package following the [official instructions](https://beyondco.de/docs/laravel-websockets/getting-started/installation)
- [x] Installed the [pusher/pusher-php-server](#) package 
- [x] Updated `config/broadcasting.php` so pusher driver points to our websocket server env variables
- [x] Installed `pusher-js` & `laravel-echo` & `vue` node modules
- [x] Updated `resources\js\bootstrap.js` to load pusher & laravel echo
- [x] Updated `resources\js\app.js` to automatically load vue components and setup a vue application
- [x] Created a `resources\js\components\EchoTest.vue` vue component & added it in the landing page view
- [x] Created a `app\Events\TestEvent.php` TestEvent class we can broadcast
- [x] 
- [x] 

## Installation

1. Clone the repository using the following command:
```
git clone https://github.com/blabla.git MyApplication
```

2. Install node modules
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