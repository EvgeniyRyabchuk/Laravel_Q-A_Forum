


@extends('layouts.public')


@section('content')

    <h1>Edit {{$user->name}} profile</h1>

    <div class="container mt-5">
        <p>
            @if($errors->any())
                {!! implode('',
                  $errors->all('<div class="alert alert-danger" role="alert">:message</div>'))
                !!}
            @endif
        </p>

        {{-- //TODO: set selected image  --}}

        <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-12 mb-3">
                <img src="/storage/{{$user->avatar}}" alt="" width="200" height="200">

                <p class="mt-3">Change avatar</p>
                <input type="file" name="avatar" id="avatar" />
            </div>

            <div class="col-md-12 mb-3">
                <label for="exampleFormControlInput1" class="form-label">User name</label>
                <input value="{{ old('name', "$user->name") }}" name="name" name="email"
                       type="text" class="form-control" id="exampleFormControlInput1" placeholder="username">
            </div>


            <div class="col-md-12">
                <label for="exampleFormControlInput1" class="form-label">About</label>
                <textarea
                    class="form-control"
                    id="about-editor"
                    name="about"
                    style="height: 300px"
                >{!! $user->about ?? '' !!}</textarea>
            </div>


            <button type="submit" class="btn btn-primary mt-3">Submit</button>

        </form>
    </div>
@endsection
