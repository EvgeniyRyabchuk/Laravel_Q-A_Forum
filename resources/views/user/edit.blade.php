


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

        <form action="/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="col-md-12 mb-3">
                <img id="avatarPreview" src="/storage/{{$user->avatar}}" alt="" width="200" height="200">

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

    <script>
        document.getElementById('avatar').onchange = function (evt) {
            let tgt = evt.target || window.event.srcElement,
                files = tgt.files;
            // FileReader support
            if (FileReader && files && files.length) {
                let fr = new FileReader();
                fr.onload = function () {
                    document.getElementById('avatarPreview').src = fr.result;
                }
                fr.readAsDataURL(files[0]);
            }
            // Not supported
            else {
                // fallback -- perhaps submit the input to an iframe and temporarily store
                // them on the server until the user's session ends.
            }
        }
    </script>

@endsection
