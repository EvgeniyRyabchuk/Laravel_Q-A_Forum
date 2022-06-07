<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrateRequest;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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

        $ticket = \App\_SL\TicketGenerator::getTicket($user);
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
            return view('public.login', compact('errorMessages', 'restoredData'));
        }


        if(is_null($user)) {
            $isValid = false;
            $emailNotValid = 'Such email doesn\'t exist';
        }

        if(!$isValid) {
            $errorMessages = compact('emailNotValid', 'passwordNotValid');
            $restoredData = compact('email', 'password');
            return view('public.login', compact('errorMessages', 'restoredData'));
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

    public function logout(Request $request) {
        Auth::logout();
        $cookie = Cookie::forget('AUTH_TICKET');
        return response()->view('public.auth.login')->withCookie($cookie);
    }
}
