<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- Meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>Laravel Websocket Starter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    </head>
    <body>

        <!-- App -->
        <div id="app">
            <div id="header">
                <h1 class="title">Laravel Websockets Starter</h1>
                <div id="nav">
                    @if (!auth()->check())
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @else
                        <a class="nav-link" href="{{ route('landing') }}">Home</a>
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    @endif
                </div>
            </div>
            <div id="content">
                @yield("content")
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        
    </body>
</html>
