@extends('layouts.guest')

@section('styles')
@endsection
@section('content')
    <div id="principal" class="login h-100 align-middle">
        <h1>&nbsp;</h1>
        <div class="container h-100">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6  text-center logo-container">
                    <img src="{{asset('images/logo_aplica2_original.png')}}" class="logo_externo"/>
                </div>
            </div>
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6 login-column">
                    <div id="login-box" class="col-md-12 card-box">
                        <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- <h3 class="text-center text-info">{{ config('app.name', 'Laravel') }}</h3> -->
                            <div class="form-group">
                                <label for="email" class="text-info">{{ __('E-Mail Address') }}:</label><br>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">{{ __('Password') }}:</label><br>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <?php /*
                                <label for="remember" class="text-info">
                                    <span>{{ __('Remember Me') }}</span>
                                    <span>
                                        <input id="remember" name="remember" type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                                    </span>
                                </label>
                                */?>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{ __('Login') }}">
                                <div id="register-link" class="text-right">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- version {{config('app.version')}} -->
    @endsection
