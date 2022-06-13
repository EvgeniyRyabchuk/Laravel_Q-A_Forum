

<li class="card-body card card-q">
    <div class="q-meta">
        <div class="q-name">
            User: <a href="./user/{{$question->user->id}}"> {{ $question->user->name }} </a>
        </div>
        <div class="q-views">
            Views: {{$question->viewCount }}
        </div>
        <div class="q-date">{{ $question->created_at }}</div>
    </div>
    <h5 class="card-title">
        <a href="{{ route('questions.show', ["lang" => app()->getLocale(), "id" => $question->id]) }}">
            {{ $question->title }}
        </a>

    </h5>
    <div class="card-text">
        {!! $question->text !!}

    </div>
    {{-- <a href="#" class="btn btn-primary">Button</a> --}}
    <div class="q-tags">
        @foreach($question->tags as $tag)
            <div class="tag"> {{ $tag->name }} </div>
        @endforeach
    </div>
</li>
