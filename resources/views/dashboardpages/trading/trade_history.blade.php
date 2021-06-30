@extends('layouts.master')

@section('content')

<div class="main-content-container">
  
    <app-traderecord-history 
        :portfolios="{{$portfolios}}" 
        :strategies="{{$strategy}}" 
        :exit_reason="{{$exitReasons}}" 
        :entryrules="{{$entryRules}}">
    </app-traderecord-history>
     
</div>

@endsection
