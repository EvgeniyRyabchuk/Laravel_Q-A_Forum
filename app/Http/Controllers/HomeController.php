<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use function Sodium\add;

class HomeController extends Controller
{
    public function index(Request $request) {
//        $locales = config('app.locales');
//        foreach (config('app.locales') as $key => $value) {
//
//           dd($key, $value);
//        }

        $recentlyViewedId = json_decode(Cookie::get('last_viewed'));

//        dd($recentlyViewedId);


        if(isset($recentlyViewedId)) {
//            $recentlyViewed = Question::whereIn('id', $recentlyViewedId)->get();
            foreach ($recentlyViewedId as $item) {
                $q = Question::find($item);
                $q->text = strip_tags(\Illuminate\Support\Str::limit($q->text, 200, $end='...'));
                $recentlyViewed[] = $q;
            }
            $recentlyViewed = array_reverse($recentlyViewed);
        }
        else {
            $recentlyViewed = [];
        }


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
        return view('public.home', compact('questions','queryParams', 'recentlyViewed'));
    }

    public function registrate() {
        return view('public.auth.registration');
    }
    public function login() {
        return view('public.auth.login');
    }

    public function about(Request $request) {

//        $question = Question::findOrFail(1);
//
//        $user = $question->user;
//        dd($user->id);
//        $question->rates()->create([
//            'user_id' => '1',
//            'type' => 'like'
//        ]);

//        $value = $request->session()->all();
//        dd($request->cookie('remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d'));
//        dd(Session::getId());
        return view('public.about');
    }

}
