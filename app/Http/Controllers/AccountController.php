<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

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
    public function index(Request $request, $id) {
        $user = User::findOrFail($id);
        $tab = $request->get('tab');
        return view("user.index", compact('user', 'tab'));
    }

    public function edit(Request $request, $id) {

        $user = User::findOrFail($id);
        if($user->id != $id)
            return '404. Page not found';

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
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
        return view('user.index', compact('user'));
    }

}
