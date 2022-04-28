<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            return redirect('/login');
        }


        // $data = Crypt::decrypt($request->cookie('AUTH_TICKET'));
        // $user = User::findOrFail($data['id']);
        // $isRemember = $data['remember_me'] == 'on' ? true : false;
        // Auth::login($user, $isRemember);
        // dd($user->id);
        // if ($request->input('token') !== 'my-secret-token') {
        //     return redirect('home');
        // }


        return $next($request);
    }
}
