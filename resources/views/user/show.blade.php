@extends('layouts.public')

@section('content')

    @include('.user.tabs')


    @isset($tab)
        @if($tab == "profile")
            @include('user.tabs.profile')
        @elseif($tab == "activity")
            @include('user.tabs.activity.index')
        @elseif($tab == "setting")
            @include('.user.tabs.setting.index')
        @else
            @include('user.tabs.activity.index')
        @endif
    @endisset

    @empty($tab)
        @include('user.tabs.profile')
    @endempty

@endsection

