

@extends('layouts.public')


@section('content')
    <div class="container">
        <form action="/session" method="POST">
            @csrf
        
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" 
                id="exampleFormControlInput1" placeholder="name@example.com" 
                value="{{ isset($restoredData['email']) ? $restoredData['email'] : ' ' }}">
                {{-- {{ $errorMessages['emailNotValid']}} --}}
        
                 @isset($errorMessages['emailNotValid'])
                  <div class="alert alert-danger" role="alert">
                    {{ $errorMessages['emailNotValid'] }} 
                  </div>
                 @endisset
              </div>
              {{ old('password') }}
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input value="{{ old('password') }}" name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                 @isset($errorMessages['passwordNotValid'])
                    <div class="alert alert-danger" role="alert">
                      {{ $errorMessages['passwordNotValid'] }} 
                    </div>
                  @endisset
                
              </div>

              <div class="form-check">
                <input name="remember_me" type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
              </div>
        
              <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection