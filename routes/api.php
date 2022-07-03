<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test_google_auth_page', function () {
    return response('Hello ' . \Illuminate\Support\Facades\Auth::user()->name);
})->middleware('auth.google');

Route::post('/logout', function (Request $request) {
    $driver = Socialite::driver('google');
    $access_token = $request->header('Authorization');
    $socialUser = $driver->userFromToken($access_token);
    $driver->revokeToken();
    dd($socialUser);
})->middleware('auth.google');
