
@extends('layouts.public')

@section('content')


    <h1>Your profile</h1>

    @foreach (Auth::user()->roles as $role)
        @if ($role->name == 'admin')
            <a href="">Create post</a>
        @endif
        @if ($role->name == 'super_admin')
            <a href="">Create user</a>
        @endif
    @endforeach

    <div class="d-flex p-3 profile-head">
        <div class="avatar-wrapper">
            <img width="100" height="100" class="avatar" src="https://lh3.googleusercontent.com/-GMbde_-IyJ8/AAAAAAAAAAI/AAAAAAAAABg/rLe9fcoGs7c/photo.jpg?sz=256" alt="" />
        </div>
        <div class="user-meta">
            <h1>{{ Auth::user()->name }}</h1>
            <hr>
            <ul class="d-flex flex-wrap">
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
                <li class="meta-item">some-text</li>
            </ul>
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
            @include('.private.user.profile')
        @elseif($tab == "activity")
            @include('.private.user.activity')
        @elseif($tab == "setting")
            @include('.private.user.setting')
        @else
            @include('.private.user.profile')
        @endif
    @endisset

    @empty($tab)
        @include('.private.user.profile')
    @endempty


@endsection

