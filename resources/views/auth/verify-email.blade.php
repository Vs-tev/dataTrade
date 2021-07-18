@extends('layouts.app')

@section('content')
<div class="position-absolute w-100 z-index-10">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff04" fill-opacity="1" d="M0,64L120,101.3C240,139,480,263,770,279.3C960,295,1200,203,1320,181.3L1440,160L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path></svg>
</div>
<div class="d-flex justify-content-center py-5 px-2 px-md-0">
    <div class="m-auto p-3 pm-0 ">
        <div class="text-center mb-5">
            <h2 class="uppercase font-weight-bolder primary">dataTrade </h2>
        </div>
        <div class="py-4 ">
            <h1 class="font-weight-bold dark text-center">Verify your email adress</h1>
        </div>
        <div class="font-xl text-dark text-center">
            @if (session('resent'))
                <div class="pt-1">
                    {{ __('A fresh verification link has been sent to this email address.') }}
                </div>
                @else
                <div>{{ __("You've entered")}} <b>{{Auth::user()->email}}</b> {{__(" as the email adress for your account.") }}</div>
                
                <div class="pt-3">
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </div>
            @endif
            
           
        </div>
        <div class="font-lg mt-5 text-center">
            {{ __('If you did not receive the email') }},
            <form class="text-center mt-2" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-link mt-2 m-auto">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection
