
@extends('layouts.public')

@section('content')

    <div class="q">
        <h1 class="q-title">{{$question->title}}</h1>
        <div class="q-meta">
            <div class="q-name">
                User: <a href="user/{{$question->user->id}}"> {{$question->user->name}} </a>
            </div>
            <div class="q-date">{{$question->created_at}}</div>
            @if(Auth::check() && Auth::user()->id == $question->user->id)
                <div class="right-question-action d-flex">
                    <a class="btn btn-warning" style="margin-right: 10px;" href="./{{$question->id}}/edit">Edit</a>
                    <form action="/questions/{{$question->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endif
        </div>
        <hr>
        <div class="q-body">
            <div class="text-block">
                {!! $question->text !!}
            </div>
            <div class="rate-block">
                <div>
                    <button id="like-btn" class="rate-btn">+</button>
                </div>
                <div>
                    <button id="dislike-btn" class="rate-btn">-</button>
                </div>
            </div>
        </div>
        <hr style="margin-bottom: 100px;">
        <p><h2 class="text-center">Answers</h2></p>
        <ul class="answers">
            @foreach($question->answers as $answer)
                <li class="answer">
                    <div class="left-side">
                        <div class="d-flex">
                            <button id="like-answer-btn" class="clear-btn rate-btn">+</button>
                            <div class="w-100 d-flex justify-content-center align-items-center">
                                <span class="d-block">{{$answer->likeCount}}</span>
                            </div>
                        </div>

                        <div class="d-flex">
                            <button id="dislike-answer-btn" class="clear-btn rate-btn">-</button>
                            <div class="w-100 d-flex justify-content-center align-items-center">
                                <span class="d-block">{{$answer->dislikeCount}}</span>
                            </div>
                        </div>
                        <br>
                        <button id="rightAnswer">Right</button>
                    </div>
                    <div class="answer-body">
                        <p class="answer-text">
                            {{$answer->text}}
                        </p>
                        <div class="answer-actions">
                            <button class="clear-btn action">Comment</button>
                            <button class="clear-btn action">Share</button>
                        </div>
                        <div class="answer-comments">
                            <div>Comments</div>
                            <ul class="comments">
                                @foreach($answer->comments as $comment)
                                    <li>{{$comment->text}} - <a href="user/{{$comment->user->id}}">{{$comment->user->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>


@endsection

<script>
    //TODO: fix wrong view arch
    //TODO: make profile for user
    //TODO: move MyUploadAdapter to separated file
    //TODO: beforeunload if file exist and delete adapter
    //TODO: tags fix

    //TODO: answer writing possibility
    //TODO: comment possibility
    //TODO: like and dislike possibility
    //TODO: right mark possibility
    //TODO: search profile, tags, questions
</script>
