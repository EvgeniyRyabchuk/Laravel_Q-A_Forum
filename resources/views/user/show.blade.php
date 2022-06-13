@extends('layouts.public')

@section('content')

    <h1>Your profile</h1>

    @auth
        @foreach (Auth::user()->roles as $role)
            @if ($role->name == 'admin')
                <a href="">Create post</a>
            @endif
            @if ($role->name == 'super_admin')
                <a href="">Create user</a>
            @endif
        @endforeach
    @endauth

    <div class="d-flex p-3 profile-head">
        <div class="avatar-wrapper">
            <img width="100" height="100" class="avatar"
                 src="/storage/{{$user->avatar}}"
                 alt=""/>
        </div>
        <div class="user-meta">
            <h1>{{ $user->name }}</h1>
            <hr>
            <ul class="d-flex flex-wrap">
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
            </ul>

            <a id="editLink" href="{{route('users.edit', [ 'lang' => app()->getLocale(), 'id' => $user->id])}}" class="btn btn-secondary">Edit profile</a>
        </div>
    </div>

    <div class="row my-3">
        <ul class="profile-tab">
            <li class="active">
                <a href="{{url()->current() . '?tab=profile'}}">Profile</a>
            </li>
            <li>
                <a href="{{url()->current() . '?tab=activity'}}">Activity</a>
            </li>
            <li>
                <a href="{{url()->current() . '?tab=setting'}}">Setting</a>
            </li>
        </ul>
    </div>


    @isset($tab)
        @if($tab == "profile")
            @include('user.profile')
        @elseif($tab == "activity")
            @include('.private.user.activity')
        @elseif($tab == "setting")
            @include('.private.user.setting')
        @else
            @include('user.profile')
        @endif
    @endisset

    @empty($tab)
        @include('user.profile')
    @endempty

@endsection

