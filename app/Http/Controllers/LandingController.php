<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Requests\Tests\SendTestMessageRequest;

class LandingController extends Controller
{
    public function getLanding()
    {
        if (!auth()->check()) return redirect()->route("login");

        return view("pages.landing");
    }

    public function postSendTestMessage(SendTestMessageRequest $request)
    {
        broadcast(new TestEvent(auth()->user(), request("message")))->toOthers();
        
        return response()->json(["status" => "success"]);
    }
}