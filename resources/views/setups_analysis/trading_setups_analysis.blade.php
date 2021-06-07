@extends('layouts.master')

@section('content')
  <div class="main-content-container ">

    <app-trade-setup-analysis 
    :entryrules="{{$entryRules}}"
    :exitreasons="{{$exitReasons}}"
    :strategies="{{$strategy}}">
    </app-trade-setup-analysis>

  </div>

@endsection
