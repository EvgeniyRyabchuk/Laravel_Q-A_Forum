<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request) {
        $defaultPerPage = 5;
        $perPage = $request->get('perPage') ?? $defaultPerPage;

        $questions = Question::all()->each(function ($question) {
            $question->text = strip_tags(\Illuminate\Support\Str::limit($question->text, 250, $end='...'));
        })->paginate($perPage);


        $queryParams = [
            'perPage' =>  $request->get('perPage'),
        ];

        if($request->get('ajax') !== null) {
            return view('public.home', compact('questions', 'queryParams'));
        }


//        $questions = Question::latest()->paginate(5);
//        dd($questions->items());
        return view('public.home', compact('questions','queryParams'));
    }

    public function registrate() {
        return view('public.registration');
    }
    public function login() {
        return view('public.login');
    }

    public function about(Request $request) {
        $value = $request->session()->all();
        dd($request->cookie('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));
        dd(Session::getId());
        return view('public.about');
    }

}
