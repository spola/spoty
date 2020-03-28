@extends('layouts.guest')

@section('styles')
<style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            /* background-color: #7386D5; */
            height: 100vh;
        }
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>
@endsection
@section('content')
    <div id="login">
        <h1>&nbsp;</h1>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="text-center text-info">{{ config('app.name', 'Laravel') }}</h3>
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
                                <br/>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="{{ __('Login') }}">
                                
                            </div>
                            <div id="register-link" class="text-right">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection