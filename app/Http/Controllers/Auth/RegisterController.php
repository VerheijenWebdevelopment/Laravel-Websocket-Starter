<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view("pages.auth.register", [
            "oldInput" => collect([
                "name" => old("name"),
                "email" => old("email"),
            ])
        ]);
    }

    public function postRegister(RegisterRequest $request)
    {
        $user = User::create([
            "name" => request("name"),
            "email" => request("email"),
            "password" => bcrypt(request("password")),
        ]);

        auth()->login($user);

        return redirect()->route("landing");
    }
}