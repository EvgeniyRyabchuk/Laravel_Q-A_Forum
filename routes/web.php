<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/registrate', [HomeController::class, 'registrate']);
Route::get('/about', [HomeController::class, 'about']);

Route::post('/registrate', [AuthController::class, 'registrate']);
Route::post('/session', [AuthController::class, 'getSession']);




Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AccountController::class, 'index']);

    Route::post('ckeditor/image_upload', [\App\Http\Controllers\CKEditorController::class, 'upload'])->name('upload');
    Route::post('ckeditor/remove ', [\App\Http\Controllers\CKEditorController::class, 'remove'])->name('remove_upload');
});

//Route::delete('/question/{id}', [QuestionController::class, 'destroy']); // delete post
//Route::resource('questions', QuestionController::class);
Route::prefix('questions')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::match(['put', 'patch'], '/{id}', [QuestionController::class, 'update']); // edit post
        Route::get('/create', [QuestionController::class, 'create']);
        Route::get('/{id}/edit', [QuestionController::class, 'edit']); // show edit post from
        Route::post('/', [QuestionController::class, 'store']); // add post
        Route::delete('/{id}', [QuestionController::class, 'destroy']); // delete post


        Route::post('/{questionId}/answer', [QuestionController::class, 'postAnswer']);
        Route::post('/{questionId}/answers/{answerId}/comments', [QuestionController::class, 'postAnswerComment']);
    });



    Route::get('/', [QuestionController::class, 'index']); // show all posts
    Route::get('/{id}', [QuestionController::class, 'show'])->middleware('viewCount'); // show open post

});


