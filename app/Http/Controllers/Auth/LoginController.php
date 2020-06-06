<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view("pages.auth.login", [
            "oldInput" => collect([
                "email" => old("email"),
            ])
        ]);
    }

    public function postLogin(LoginRequest $request)
    {
        $user = User::where("email", request("email"))->first();

        if (!auth()->attempt(["email" => request("email"), "password" => request("password")], true))
        {
            return redirect()->route("login");
        }

        return redirect()->route("landing");
    }
}