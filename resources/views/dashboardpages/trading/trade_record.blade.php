@extends('layouts.master')

@section('content')

<div class="main-content-container">
    <div id="VueTradeRecord" class="content-container">

     {{-- $trade come from AppServiceProvider
        <app-traderecord :trade="{{$trade}}"></app-traderecord> --}}
     <app-traderecord :strategies="{{$strategy}}" :exit_reason="{{$exitReasons}}" :entryrules="{{$entryRules}}"></app-traderecord>

    </div>

</div>
@endsection