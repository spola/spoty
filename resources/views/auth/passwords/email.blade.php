@extends('layouts.guest')

@section('content')
<h1>&nbsp;</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="col-md-12 card-box">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h3 class="text-center text-info">{{ config('app.name', 'Laravel') }}</h3>

                        <h5 class="text-left text-info">{{ __('Reset Password') }}</h5>


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
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="{{ __('Send Password Reset Link') }}">
                        </div>

                        <div id="register-link-2" class="text-right" style="margin-top:-50px">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                Volver
                            </a>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
