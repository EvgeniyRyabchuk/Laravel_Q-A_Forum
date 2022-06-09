<?php

namespace App\Http\Middleware;

use App\Models\Question;
use App\Models\QuestionView;
use App\Models\View;
use Closure;
use Illuminate\Http\Request;

class ViewCounterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
//    public function handle(Request $request, Closure $next)
//    {
//        $qId = $request->route()->parameter('id');
////        $ip = $request->ip();
//        $ip = $request->ip() . '.' . rand(1, 300); // for test
//        $user_agent = $request->userAgent();
//
//
//        $view = QuestionView::where(['question_id' => $qId, 'ip' => $ip])->first();
//        $question = Question::findORFail($qId);
//
//        if(is_null($view)) {
//            $view = new QuestionView();
//            $view->ip = $ip;
//            $view->user_agent = $user_agent;
//            $question->views()->save($view);
//            $question->viewCount =$question->viewCount + 1;
//            $question->save();
//        }
//
//        return $next($request);
//    }

    public function handle(Request $request, Closure $next)
    {
//        $id = $request->route()->parameter('id');
//        $ip = $request->ip() . '.' . rand(1, 300); // for test
//        $user_agent = $request->userAgent();
//
//
//        $view = View::where(['viewble_id' => $id, 'ip' => $ip])->first();
//        $model = $request->url();
//        $question = Question::findORFail($id);
//
//        if(is_null($view)) {
//            $view = new QuestionView();
//            $view->ip = $ip;
//            $view->user_agent = $user_agent;
//            $question->views()->save($view);
//            $question->viewCount =$question->viewCount + 1;
//            $question->save();
//        }

        return $next($request);
    }
}
