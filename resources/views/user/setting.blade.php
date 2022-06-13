


@extends('layouts.public')

@section('content')
    @include('.user.tabs')

    @include('.user.tabs.setting.index')
{{--    @isset($tab)--}}
{{--        @if($tab == "preferences")--}}
{{--            @include('user.tabs.setting.index')--}}
{{--        @elseif($tab == "activity")--}}
{{--            @include('user.tabs.activity.index')--}}
{{--        @elseif($tab == "setting")--}}
{{--            @include('.user.tabs.setting.index')--}}
{{--        @else--}}
{{--            @include('user.tabs.activity.index')--}}
{{--        @endif--}}
{{--    @endisset--}}

{{--    @empty($tab)--}}
{{--        @include('user.tabs.profile')--}}
{{--    @endempty--}}

@endsection
