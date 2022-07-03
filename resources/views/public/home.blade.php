
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
            @include('partial_view.question.index')
        </div>

        <ul class="d-flex" style="overflow-x: auto;">
            @foreach($recentlyViewed as $recentlyItem)
                <li style="display: block;
                border: 1px solid black;
                 margin: 10px;
                 min-width: 200px;
                 padding: 10px;
                  ">
                    <h4>{{$recentlyItem->title}}</h4>
                    <p>
                        {{ $recentlyItem->text }}
                    </p>
                </li>
            @endforeach
        </ul>

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

{{--    {{--}}
{{--      dd($recentlyViewed)--}}
{{-- }}--}}

@endsection
