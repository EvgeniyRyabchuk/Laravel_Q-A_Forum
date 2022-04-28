<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('private.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question();
//        $question->user()->associate(Auth::user());
        $question->user_id = Auth::user()->id;
        $this->save($question, $request);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::findOrFail($id);
        return view('public.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('private.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function save($question, Request $request) {
        $question->title = $request->input('title');
        $question->text = $request->input('summary-ckeditor');
        $question->save();

        $tagsStr = $request->input('tagList');
//        dd($tagsStr);
        $question->tags()->detach();

        if(!is_null($tagsStr)) {
            $tagsArr = explode(',', $tagsStr);
            foreach ($tagsArr as $item) {
                $tag = Tag::where(['name' => $item])->first();
                if (is_null($tag)) {
                    $tag = new Tag();
                    $tag->name = $item;
                    $tag->save();
                }
                $question->tags()->attach($tag->id);
            }

        }
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $question = Question::findOrFail($id);
        $this->save($question, $request);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect('/');
    }
}
