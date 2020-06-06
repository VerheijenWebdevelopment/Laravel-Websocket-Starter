<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function getLanding()
    {
        return view("pages.landing");
    }
}