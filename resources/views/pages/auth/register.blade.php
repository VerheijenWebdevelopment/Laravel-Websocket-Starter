@extends("layouts.app")

@section("content")
    
    <h2>Register</h2>

    <form action="{{ route('register.post') }}" method="post">
        @csrf

        <div id="register-form">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="email" placeholder="E-mail address">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password_confirmation" placeholder="Confirm password">
            <div id="register-form__submit">
                <button type="submit">
                    Create your account
                </button>
            </div>
        </div>

    </form>

@stop