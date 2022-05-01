


@isset($answer)
    @foreach($answer->comments as $comment)
        <li>{{$comment->text}} - <a href="user/{{$comment->user->id}}">{{$comment->user->name}}</a></li>
    @endforeach
@endisset

