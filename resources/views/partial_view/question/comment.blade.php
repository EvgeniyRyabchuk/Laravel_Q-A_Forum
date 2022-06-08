


@isset($answer)
    @foreach($answer->comments as $comment)
        <li>{{$comment->text}} - <a href="{{route('users.show', ["lang" => app()->getLocale(), "userId" => $comment->user->id])}}">{{$comment->user->name}}</a></li>
    @endforeach
@endisset

