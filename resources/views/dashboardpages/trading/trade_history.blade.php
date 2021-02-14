@extends('layouts.master')

@section('content')


{{-- backdrop container--}}
<div id="cover" class=""></div>
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
