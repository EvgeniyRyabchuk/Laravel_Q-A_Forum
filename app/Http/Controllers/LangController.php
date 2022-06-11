<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\_SL\Utils;

class LangController extends Controller
{
    public function change(Request $request) {

        $request = new \Illuminate\Http\Request();

        $routeName = $request->input('currentRouteName');
        $lang = $request->input('lang');
        $request->route()->forgetParameter();
        $lang =  Utils::setLang($lang);
        $url = '/' . $lang . \Illuminate\Support\Facades\Request::path();;
        return response()->json(['res' => 'success', 'newUrl' => $url], 201);
    }
}
