@extends('layouts.authForm.users')

@section('content')
    
<form class="register-form" method="POST" action="{{ route('regster') }}">
  @csrf

  <div class="form-group">
      <label>Name</label>
      
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
  </div>


  <div class="form-group">
      <label>Email</label>
      
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
  </div>

  <div class="form-group">
      <label>Password</label>
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
  <button class="btn btn-danger btn-block btn-round">Register</button>
</form>


@endsection