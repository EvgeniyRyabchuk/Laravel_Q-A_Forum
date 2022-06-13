

<li class="card-body card card-q" style="padding: 10px;">
    <div class="q-meta">
        <div class="q-views">
            Views: {{$question->viewCount }}
        </div>
        <div class="q-date">{{ $question->created_at }}</div>
    </div>
    <h5 class="card-title" style="font-size: 20px;">
        <a href="{{ route('questions.show', ["lang" => app()->getLocale(), "id" => $question->id]) }}">
            {{ $question->title }}
        </a>

    </h5>
</li>
