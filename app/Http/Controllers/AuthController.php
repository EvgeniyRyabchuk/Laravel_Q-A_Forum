<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrateRequest;
use App\Models\AccessToken;
use App\Models\RefreshTokens;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function registrate(RegistrateRequest $request) {
        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $hash = hash("sha256", $request->post("password") . env("APP_SECRET"));
        $user->password = $hash;
        $user->save();
        // return response("layouts.home")
        // ->header('Content-Type', 200)
        // ->cookie('name', 'value', 3);

        $remember_me = $request->post('remember_me');
        $ticket = \App\_SL\TicketGenerator::getTicket($user, $remember_me);
        $encryptTcket = Crypt::encrypt($ticket);
        Auth::login($user);
        return redirect('/')->withCookie(cookie('AUTH_TICKET', $encryptTcket, $ticket['expire']));
        // return redirect('/')->withCookie(cookie('AUTH_TICKET', $encryptTicket, $minutes));
    }

    public function getSession(Request $request) {
        $email = $request->post('email');
        $password = $request->post('password');
        $pwdHash = hash("sha256", $password . env('APP_SECRET'));
        $isValid = true;
        $remember_me = $request->post('remember_me');

        $user = User::where('email', $email)->first();

        $request->old('password');

        $emailNotValid = null;
        $passwordNotValid = null;

        // first level of validation
        if(is_null($email)) {
            $isValid = false;
            $emailNotValid = 'Email is empty';
        }
        if(is_null($password)) {
            $isValid = false;
            $passwordNotValid = 'Password is empty';
        }

        if(!$isValid) {
            $errorMessages = compact('emailNotValid', 'passwordNotValid');
            $restoredData = compact('email', 'password');
            return view('public.auth.login', compact('errorMessages', 'restoredData'));
        }


        if(is_null($user)) {
            $isValid = false;
            $emailNotValid = 'Such email doesn\'t exist';
        }

        if(!$isValid) {
            $errorMessages = compact('emailNotValid', 'passwordNotValid');
            $restoredData = compact('email', 'password');
            return view('public.auth.login', compact('errorMessages', 'restoredData'));
        }

        // second level of validation
        if($user->password != $pwdHash) {
            $isValid = false;
            $passwordNotValid = "Password is not valid";
        }
        if(!$isValid) {
            $errorMessages = compact('emailNotValid', 'passwordNotValid');
            $restoredData = compact('email', 'password');
            return redirect('/login')->withInput($request->input());
            //  view('public.login', compact('errorMessages', 'restoredData'))->withInput();
        }

        Auth::login($user);
        $ticket = \App\_SL\TicketGenerator::getTicket($user, $remember_me);
        $encryptTcket = $encryptTicket = Crypt::encrypt($ticket);


        return redirect()
            ->route('users.show', ["lang" => App::getLocale(), "userId" => $user->id])
            ->withCookie(cookie('AUTH_TICKET', $encryptTcket, $ticket['expire']));
    }

    public function googleRedirect() {
        return Socialite::driver('google')
           // ->scopes() // For any extra scopes you need, see https://developers.google.com/identity/protocols/googlescopes for a full list; alternatively use constants shipped with Google's PHP Client Library
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();
    }

    public function loginWithGoogle() {

        //TODO: google offline auth system

        // how to set expire value
        // how to revoke access token
        // refactor db for refresh token
        // react google auth

        // laravel oauth2 example

        $googleUser = Socialite::driver('google')->user();

        if($googleUser) {
            $newDateTimeRefreshToken = Carbon::now()->addMonth(1);
            $newDateTimeAccessToken = Carbon::now()->addMinutes(20);

            $user = User::where('email', $googleUser->email)->first();

            if($user) {
                $user->accessTokens()->save(
                    new AccessToken([
                        'token' => $googleUser->token,
                        'expired_at' => $newDateTimeAccessToken,
                    ])
                );
            }
            else {
                $user = new User();
                $user->auth_type = 'google';
                $user->google_id = $googleUser->id;
                $user->name = $googleUser->name;
                $user->email = $googleUser->email;
            }

            //TODO: why not work
//            $user = User::updateOrCreate([
//                'google_id' => $googleUser->id,
//            ], [
//                'name' => $googleUser->name,
//                'email' => $googleUser->email,
//                'google_token' => $googleUser->token,
//                'google_refresh_token' => $googleUser->refreshToken,
//            ]);

            $user->save();
            $user->refreshTokens()->save(
                new RefreshTokens([
                    'token' => $googleUser->refreshToken,
                    'expired_at' => $newDateTimeRefreshToken,
                ])
            );
            $user->accessTokens()->save(
                new AccessToken([
                    'token' => $googleUser->token,
                    'expired_at' => $newDateTimeAccessToken,
                ])
            );

            Auth::login($user);

            return redirect('/')
                ->withCookie(cookie('refresh_token', $googleUser->refreshToken, 60 * 24 * 30));
        }
    }


    public function loginWithGoogleApi(Request $request)
    {
        $accessToken = $request->input('accessToken');

        $driver = Socialite::driver('google');

        $socialUser = $driver->userFromToken($accessToken);

        dd($socialUser);

        $user = User::where('email', $socialUser->user['email'])->first();

//        Auth::login($user);

    }

    public function logout(Request $request) {
        Auth::logout();
        $cookie = Cookie::forget('AUTH_TICKET');
        return response()->view('public.auth.login')->withCookie($cookie);
    }
}
