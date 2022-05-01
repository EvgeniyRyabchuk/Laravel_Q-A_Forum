
<li class="answer">
    <div class="left-side">
        <div class="d-flex">
            <button id="like-answer-btn" class="clear-btn rate-btn">+</button>
            <div class="w-100 d-flex justify-content-center align-items-center">
                <span class="d-block">{{$answer->likeCount ?? '0'}}</span>
            </div>
        </div>

        <div class="d-flex">
            <button id="dislike-answer-btn" class="clear-btn rate-btn">-</button>
            <div class="w-100 d-flex justify-content-center align-items-center">
                <span class="d-block">{{$answer->dislikeCount ?? '0'}}</span>
            </div>
        </div>
        <br>
        <button id="rightAnswer">Right</button>
    </div>
    <div class="answer-body">
        <div class="author">
            <a href="/user/{{$answer->user->id ?? ''}}">User: {{$answer->user->name ?? ''}}</a>
        </div>
        <div class="answer-text">
            {!!  $answer->text ?? '' !!}
        </div>
        <div class="answer-actions">
            <button class="clear-btn action add-comment-btn">Add a comment</button>
            <button class="clear-btn action">Share</button>
        </div>

        <div class="comment-form" contentEditable>
            <form class="postCommentForm" action="{{ isset($answer) ? url("/questions/$question->id/answers/$answer->id/comments") : '' }}" method="post">
                @csrf
                <input id="answerId" type="hidden" value="{{$answer->id}}">
                <textarea name="text" id="text"></textarea>
                <div class="d-flex justify-content-end mt-2 mb-4">
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </div>
            </form>
        </div>

        <div class="answer-comments">
            <div>Comments</div>
            <ul class="comments">
                @include('partial_view.question.comment')
            </ul>
        </div>

    </div>
</li>



<div></div>