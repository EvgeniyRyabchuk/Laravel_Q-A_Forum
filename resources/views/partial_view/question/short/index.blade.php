

<ul id="question-list">
    @foreach($questions as $question)
        @include('partial_view.question.short.short-question')
    @endforeach
</ul>


<div class="example-shot-question" style="display: none;">
    <li class="card-body card card-q" style="padding: 10px;">
        <div class="q-meta">
            <div class="q-views">
                Views: 0
            </div>
            <div class="q-date">Date</div>
        </div>
        <h5 class="card-title" style="font-size: 20px;">
            <a href="/">
                title
            </a>
        </h5>
    </li>
</div>

