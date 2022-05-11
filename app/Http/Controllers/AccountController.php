<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
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
        //TODO: validate, compress, create directory
        $user = User::findOrFail($id);
        if($user->id != $id)
            return '404. Page not found';

        $user->name = $request->input('name');
        $user->about = $request->input('about');

        if($request->hasFile('avatar')) {
            $files =  Storage::allFiles("users/$user->id/avatar");
            Storage::delete($files);

            $file = $request->file('avatar');
//        $timespan = microtime();
            $path = Storage::put("/users/$user->id/avatar", $file);
            $user->avatar = $path;
        }

        $user->save();
        return view('user.index', compact('user'));
    }

}
