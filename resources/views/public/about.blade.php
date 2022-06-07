

@extends('layouts.public')


@section('content')

<div class="container">

    <h1>{{ __('About this site') }}</h1>

    <p>{{ __('aboutMessage') }}</p>
    <h3>{{ __('This is test web site for check cookies auth method') }} </h3>


    <p>{{ __('Check out my github profile for more details about me') }} -
        <a href="https://github.com/EvgeniyRyabchuk">EvgeniyRyabchuk</a>
    </p>
</div>

@endsection
