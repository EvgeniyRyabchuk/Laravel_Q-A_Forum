<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $tab = $request->get('tab');
        return view("private.user.index", compact('user', 'tab'));
    }


}
