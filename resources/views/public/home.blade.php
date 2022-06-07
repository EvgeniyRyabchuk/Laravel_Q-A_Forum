
@extends('layouts.public')

@section('content')


    <h1 style="margin-top: 10px; text-align: center; ">Wellcome to the home page</h1>


    <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-current="true" href="#">Active</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
            <ul id="question-list">
                @foreach($questions as $question)
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
                @endforeach
            </ul>
        </div>

        <div class="d-flex justify-content-between my-5" style="padding: 0 169px; " >

            {{ $questions->links('partial_view.paginate.paginate', compact('queryParams')) }}
            <div>
                Per page
                <a type="button" class="btn btn-info btn-per-page" href="?perPage=5">5</a>
                <a type="button" class="btn btn-info btn-per-page" href="?perPage=10">10</a>
                <a type="button" class="btn btn-info btn-per-page" href="?perPage=20">20</a>
            </div>
        </div>
      </div>

{{--    <script>--}}
{{--        for(let item of document.querySelectorAll('.btn-per-page')) {--}}
{{--            item.addEventListener('click', (e) => {--}}
{{--                const count = e.target.innerText; --}}
{{--                --}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}

@endsection
