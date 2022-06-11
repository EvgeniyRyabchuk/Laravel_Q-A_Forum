<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\_SL\Utils;

class SetLangMiddleware
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
        $langSession = Session::get("lang");
        $langRequest = $request->route('lang');

        if(!is_null($langSession)) {
            if($langRequest != null) {
                if($langRequest != $langSession) {
                    $langSession = $langRequest;
                }
            }
            Utils::setLang($langSession);
        }
        else {
            if($langRequest == null) {
                $path = \Illuminate\Support\Facades\Request::path();
                $lang = Utils::setLang();
                $url = '/' . $lang . $path;
                return response()->redirectTo($url);
            }
            else {
                Utils::setLang($langRequest);
            }
        }

        return $next($request);
    }



}
