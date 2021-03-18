@extends('layouts.master')

@section('content')


{{-- backdrop container--}}

<div class="main-content-container">
  
    <app-traderecord-history 
        :portfolios="{{$portfolios}}" 
        :strategies="{{$strategy}}" 
        :exit_reason="{{$exitReasons}}" 
        :entryrules="{{$entryRules}}">
    </app-traderecord-history>
     
    {{-- Trade deteils --}}
   
    
</div>

@endsection
