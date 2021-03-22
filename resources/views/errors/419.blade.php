@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('message')
<div class="d-flex align-items-center justify-content-center h-100">
    <div class="col-12 col-md-9 text-center">
        <div class="py-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock" width="120" height="120" viewBox="0 0 24 24" stroke-width="0.5" stroke="#ed5249" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="12" r="9" />
                <polyline points="12 7 12 12 15 15" />
              </svg>
        </div>
        <h1 class="text-center font-weight-400 py-2">Your session has expired due to inactivity.</h1>
        <h3>Please Log in again from <a href="{{route('login')}}" class="primary font-500 h3">HERE</a></h3>
        
    </div>

</div>
