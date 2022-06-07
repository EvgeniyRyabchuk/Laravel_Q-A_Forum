

@extends('layouts.public')


@section('content')
    <div class="container">
      <p>
        {{-- @error('name')
            Name is empty
        @enderror --}}

        {{-- @isset($error)
          @foreach ($error->any() as $error)
            {{ $error }}
          @endforeach
        @endisset --}}
        @if($errors->any())
          {!! implode('',
            $errors->all('<div class="alert alert-danger" role="alert">:message</div>'))
          !!}
        @endif
      </p>
        <form action="{{route('users.store', app()->getLocale())}}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">User name</label>
              <input value="{{ old('name', 'Name 1') }}" name="name" name="email"
              type="text" class="form-control" id="exampleFormControlInput1" placeholder="username">
            </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input value="{{ old('email') }}"  name="email" type="email"
                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password"
                 class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password_confirmation" type="password" class="form-control"
                id="exampleInputPassword1" placeholder="Repeat Password">
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
