
@extends('layouts.public')

@section('content')
    <h1>Your profile</h1>

    <h3>Hello {{ Auth::user()->name }}</h3> 

    @foreach (Auth::user()->roles as $role)
        @if ($role->name == 'admin')
            <a href="">Create post</a> 
        @endif
        @if ($role->name == 'super_admin')
            <a href="">Create user</a> 
        @endif
    @endforeach

@endsection

