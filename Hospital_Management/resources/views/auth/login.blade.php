<!-- @extends('layouts.app') -->
<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
@section('content')
<div class="container">
    <div class="center" >
           <img src="assets/img/logo.png">
          <h2>Hospital Management</h2>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <h4>Login</h4>
            <div class="txt_field">
              <!-- <input type="text" required> -->
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              <span></span>
              <label>Username</label>
            </div>
            <div class="txt_field">
              <!-- <input type="password" required> -->
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              <span></span>
              <label>Password</label>
            </div>
            <div class="pass">
                @if (Route::has('password.request'))
                                        <a style href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
            </div>
            <input type="submit" value="Login">
          </form>
        </div>
    <!--  -->
</div>
@endsection
