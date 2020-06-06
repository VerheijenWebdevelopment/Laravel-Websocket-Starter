<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", "LandingController@getLanding")->name("landing");

Route::get("login", "Auth\LoginController@getLogin")->name("login");
Route::post("login", "Auth\LoginController@postLogin")->name("login.post");

Route::get("register", "Auth\RegisterController@getRegister")->name("register");
Route::post("register", "Auth\RegisterController@postRegister")->name("register.post");

Route::get("logout", "Auth\LogoutController@getLogout")->name("logout");

Route::post("send-test-message", "LandingController@postSendTestMessage")->name("send-test-message.post");