

<ul id="question-list">
    @foreach($questions as $question)
        @include('partial_view.question.question')
    @endforeach
</ul>
