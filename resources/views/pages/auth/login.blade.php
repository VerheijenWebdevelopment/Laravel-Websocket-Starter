@extends("layouts.app")

@section("content")
    
    <h2>Login</h2>

    <form action="{{ route('login.post') }}" method="post">
        @csrf

        <div id="login-form">
            <input type="text" name="email" placeholder="E-mail address">
            <input type="password" name="password" placeholder="Password">
            <div id="login-form__submit">
                <button type="submit">
                    Login
                </button>
            </div>
        </div>

    </form>

@stop