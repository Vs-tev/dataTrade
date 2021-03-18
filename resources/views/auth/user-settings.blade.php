@extends('layouts.master')

@section('content')

<div class="main-content-container">
  
    <div class="content-container py-0 mt-4">
        <user-settings 
            :countries="{{$countries}}"
            @auth
                :user="{{auth()->user()}}"
            @endauth>
        </user-settings>
    </div>  
   
</div>
@endsection