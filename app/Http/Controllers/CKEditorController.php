<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $userId = Auth::user()->id;

            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs("public/uploads/$userId", $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');

            $url = asset("storage/uploads/$userId/" . $filenametostore);
            $msg = 'Image successfully uploaded';

            return response()->json([
                'url' => $url
            ]);
        }
        return response()->json([
            'msg' => 'Error upload file on the server'
        ], 501);
    }

    public function remove(Request $request) {
        $urlArr = $request->post('urlList');
        $userId = Auth::user()->id;

        if (is_null($urlArr) || count($urlArr) == 0)
            return response()->json( ['err' => 'images doesn\'t e'], 401);

        foreach ($urlArr as $url) {
            // parsed path
            $path = parse_url($url, PHP_URL_PATH);
            // extracted basename
            $filename = basename($path);
            $path = public_path("storage/uploads/$userId/$filename");
            if( file_exists($path)) {
                unlink(storage_path("app/public/uploads/$userId/$filename"));
                return response()->json('File deleted.', 201);
            }else{
                return response()->json('File does not exists.', 501);
            }
        }
    }
}
