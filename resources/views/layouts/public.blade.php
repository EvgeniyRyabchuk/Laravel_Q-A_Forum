<!DOCTYPE html>
<html lang="en">
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
        <a class="nav-item" href="/"><span>Main</span></a>
        @if (Auth::check())
            <form action="/logout" method="POST">
                <button class="nav-item" >Log out</button>
            </form>
            <a class="nav-item" href="/profile"><span>Profile</span></a>
            <a class="nav-item create-btn" href="/questions/create"><span>Create Question</span></a>
        @else
            <a class="nav-item" href="/login"><span>Log in</span></a>
            <a class="nav-item" href="/registrate"><span>Registration</span></a>
        @endif

        <a class="nav-item" href="about"><span>About</span></a>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>

    </footer>

    @yield('js')
</body>
</html>
