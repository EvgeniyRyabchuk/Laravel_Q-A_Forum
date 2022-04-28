
@extends('layouts.public')

@section('content')

    <h1>Edit question</h1>

    @include('partial_view.question.questionCreateEdit', compact('question'))

@endsection
