<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\LangController;
use Illuminate\Http\Request;
use App\_SL\Utils;

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


//Route::redirect('/', request()->getPreferredLanguage(array_flip(config('app.locales'))) ?? '/en');
Route::redirect('/', '/en');


Route::post('change_lang', [LangController::class, "change"])->name('lang.change');


//TODO: what if lang is doesn't exist on home page
//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('{lang}')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::get('/registrate', [HomeController::class, 'registrate'])->name('registrate');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    Route::post('/registrate', [AuthController::class, 'registrate'])->name('users.store');
    Route::post('/session', [AuthController::class, 'getSession'])->name('session.store');


    Route::get('/users', [AccountController::class, 'index'])->name('users');
    Route::get('/users/{userId}', [AccountController::class, 'show'])->name('users.show');
    Route::get('/users/{userId}/posts', [AccountController::class, 'posts'])->name('users.posts.short');

    Route::get('/users/{userId}/setting', [AccountController::class, 'setting'])->name('users.setting');

    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::post('ckeditor/image_upload', [CKEditorController::class, 'upload'])->name('upload');
        Route::post('ckeditor/remove ', [CKEditorController::class, 'remove'])->name('remove_upload');

        Route::post('/rate/{targetId}', [RateController::class, 'simpleRate'])->name('rate.store');

        Route::post('/answers/{answerId}/useful', [QuestionController::class, 'markAsUseful'])->name('answers.markAsUseful');

        Route::match(['put', 'patch'],'/users/{id}', [AccountController::class, 'update'])->name('users.update');
        Route::get('/users/{id}/edit', [AccountController::class, 'edit'])->name('users.edit');


    });


    Route::prefix('questions')->group(function () {
        Route::middleware(['auth'])->group(function () {
            Route::match(['put', 'patch'], '/{id}', [QuestionController::class, 'update'])->name('questions.update'); // edit post

            Route::get('/create', [QuestionController::class, 'create'])->name('questions.create');
            Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit'); // show edit questions from
            Route::post('/', [QuestionController::class, 'store'])->name('questions.store'); // add questions
            Route::delete('/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy'); // delete questions


            Route::post('/{questionId}/answer', [QuestionController::class, 'postAnswer'])->name('questions.answers.postAnswer');;
            Route::post('/{questionId}/answers/{answerId}/comments', [QuestionController::class, 'postAnswerComment'])->name('questions.answers.comments.postAnswerComment');;
        });



        Route::get('/', [QuestionController::class, 'index'])->name('questions');; // show all posts
        Route::get('/{id}', [QuestionController::class, 'show'])->middleware('viewCount')->name('questions.show');; // show open post

    });

});

