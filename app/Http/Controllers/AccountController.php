<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use App\_SL\Utils;

class AccountController extends Controller
{
    /*

                if(!File::exists('storage/users')) {
                Storage::makeDirectory('users');
            }
            if(!File::exists("storage/users/$user->id")) {
                Storage::makeDirectory("storage/users/$user->id");
            }
            if(!File::exists("storage/users/$user->id/avatar")) {
                Storage::makeDirectory("storage/users/$user->id/avatar");
            }
//        $timespan = microtime();
    */
    public function index(Request $request, $lang) {

    }

    public function show(Request $request, $lang, $id) {
        $user = User::findOrFail($id);
        $tab = $request->get('tab');

        if($tab == 'profile' || $tab == null) {
            $questions = $this->getPosts('all', 'newest', $id, 5);

            return view("user.show", compact('user', 'tab', 'questions'));
        }

        return view("user.show", compact('user', 'tab'));
    }

    public function edit(Request $request, $lang,  $id) {

        $user = User::findOrFail($id);
        if($user->id != $id)
            return '404. Page not found';

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $lang, $id) {
        //TODO: compress
        $request->validate([
            'name' => 'required|min:2|max:200',
            'avatar' => 'dimensions:min_width=200,min_height=200,max_width=2000,max_height=2000|'
            . 'mimes:jpg,bmp,png'
        ]);

        $user = User::findOrFail($id);

        if($user->id != $id)
            return '404. Page not found';


        $name = $request->input('name');
        if($user->name != $name)
        {
            $isAlreadyExist = (bool)User::where('name', $name)->first();
            if($isAlreadyExist) {
                return Redirect::back()
                    ->withErrors(['name' => 'User with same name already exist'])
                    ->withInput(['name' => $name]);
            }
        }

        $user->name = $request->input('name');
        $user->about = $request->input('about');

        if($request->hasFile('avatar')) {
            $files =  Storage::allFiles("users/$user->id/avatar");
            Storage::delete($files);
            $file = $request->file('avatar');
            $path = Storage::put("/users/$user->id/avatar", $file);
            $user->avatar = $path;
        }

        $user->save();
        return view('user.show', compact('user'));
    }

    public function posts(Request $request, $lang, $userId) {

        $user = User::findOrFail($userId);
        $postType = $request->input('type');
        $postSort = $request->input('sort');

        $posts = $this->getPosts($postType, $postSort, $userId, 5);
        return response()->json($posts, 201);
    }


    private function getPosts($type, $sort, $userId, $perPage) {
        switch ($type)
        {
            case 'all':
                $posts = Question::where('user_id', $userId)->get();
                $userAnswers = Answer::where('user_id', $userId)->get();
                foreach ($userAnswers as $answer) {
                    $question = $answer->question;
                    $posts->add($question);
                }
                break;
            case 'questions':
                $posts = Question::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
                break;
            case 'answers':
                $userAnswers = Answer::where('user_id', $userId)->get();

                $posts = \Illuminate\Database\Eloquent\Collection::make(new Question);
                foreach ($userAnswers as $answer) {
                    $question = $answer->question;
                    $posts->add($question);
                }
                break;
        }
        if($sort != null) {
            switch ($sort) {
                case 'newest':
                    //TODO: why here appear problem with return type in Collection sortBy
                    $posts = $posts->sortByDesc(function ($item) {
                        return $item['created_at'];
                    })->values();
                    break;
                case 'score':
                    $posts = $posts->sortByDesc('id')->values();
                    break;
            }
        }

        return $posts->paginate($perPage);
    }

}
