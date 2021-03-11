
@extends('layouts.app')

@section('content')

@include('auth.auth-aside')
<div class="right-side pt-5">
    <div class="login-content d-flex justify-content-center py-5">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="pb-5">
            <h1 class="font-weight-bold">Welcome to dataTrade</h1>
            <h4 class="lighter font-weight-500">Don't have account? <span><a href="{{ route('register') }}" class="text-decoration-none">Create an account</a></span></h4>
        </div>
        <div class="form-group mb-5">
            <input id="email" type="email" class="form-control auth-input @error('email') is-invalid @enderror" name="email" placeholder="Email adress">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <p class="error-output">{{$message}}</p>
                </span>
            @enderror
        </div>
        
        
        <div class="form-group mb-1">
            <input id="password" name="password" type="password" class="form-control auth-input @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <p class="error-output">{{$message}}</p>
            </span>
            @enderror

        </div>
        <div class="form-group mb-5 ">
                <div class="form-check pt-4">
                    <div class="custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember"
                            {{ old('remember') ? 'checked' : ''}}>
                        <label class="custom-control-label lighter font-500" for="remember">{{ __('Remember Me') }}</label>
                    </div>

                </div>
         
        </div>

        <div class="form-group mb-5">
            <div class="d-flex align-items-center justify-content-between">
                <button type="submit" class="btn btn-primary auth-btn">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="font-lg font-weight-bold text-decoration-none">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
@endsection