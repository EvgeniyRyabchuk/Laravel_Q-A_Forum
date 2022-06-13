<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">

     <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" type="text/css">
{{--    <script src="{{ URL::asset('js/app.js') }}"></script>--}}
    @yield('css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('head-js')
</head>
<body>

<style>
    .create-btn {
        background-color: cornflowerblue;
        color: white;
    }
    .create-btn:hover {
        background-color: darkblue;
        color: white;
    }
</style>
    <header>
        <a class="nav-item" href="{{route('home', app()->getLocale())}}"><span>Main</span></a>
        @if (Auth::check())
            <form action="{{ route('logout', app()->getLocale()) }}" method="POST">
                <button class="nav-item" >Log out</button>
            </form>
            <a class="nav-item"
               href="{{ route('users.show', ["lang" => app()->getLocale(), 'userId' => Auth::user()->id, "tab" => "profile"]) }}"><span>Profile</span></a>
            <a class="nav-item create-btn" href="{{ route('questions.create', app()->getLocale()) }}"><span>Create Question</span></a>
        @else
            <a class="nav-item" href="{{ route('login', app()->getLocale()) }}"><span>Log in</span></a>
            <a class="nav-item" href="{{ route('registrate', app()->getLocale()) }}"><span>Registration</span></a>
        @endif

        <a class="nav-item" href="{{ route('about', app()->getLocale()) }}"><span>About</span></a>


        <select style="width: 150px" class="form-select" aria-label="Select Lang" id="langSelect">
            @foreach (config('app.locales') as $key => $value)
                <option {{ $key == app()->getLocale() || $key == config('app.locale') ? 'selected' : false }}
                 value="{{$key}}">
                    {{$value}}
                </option>
            @endforeach
        </select>

        <script>
            document.querySelector('#langSelect').addEventListener('change', async (e) => {
                const lang = e.target.value;
                const path = location.pathname.split('/').filter(e => e != '{{app()->getLocale()}}').join('/');
                const url = `/${lang}${path}`;
                window.location.href = `/${lang}${path}`;
            })
        </script>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="row">
            <div class="col-md-2">
                <ul>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                </ul>
            </div>
            <div class="col-md-2">
                <ul>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="text-center">
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                    <li>Lorem ipsum dolor.</li>
                </ul>
            </div>
        </div>
    </footer>


    @yield('js')

</body>
</html>
