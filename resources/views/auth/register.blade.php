@extends('layouts.app')

@section('content')

@include('auth.auth-aside')
<div class="right-side pt-5">
    <div class="login-content d-flex justify-content-center py-5">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="pb-5">
                <h1 class="font-weight-bold">Sing Up</h1>
                <h4 class="lighter font-weight-500">Already registered? <span><a href="{{ route('login') }}" class="text-decoration-none">Log in here</a></span></h4>
            </div>
            <div class="form-group mb-5">
                <input id="name" type="text" class="form-control auth-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Username" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <p class="error-output">{{$message}}</p>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-5">
                <input id="email" type="email" class="form-control auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email adress" required autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <p class="error-output">{{$message}}</p>
                </span>
                @enderror
            </div>
            <div class="form-group mb-5">
                <input id="password" type="password" class="form-control auth-input @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <p class="error-output">{{$message}}</p>
                </span>
                @enderror

            </div>
            <div class="form-group mb-5">
                <input id="password-confirm" type="password" class="form-control auth-input" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
            </div>

            <div class="form-group mb-4">
                <button type="submit" onclick="" class="btn btn-primary auth-btn">Sing Up</button>
            </div>
        </form>

    </div>
</div>
@endsection
