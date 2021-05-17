@extends('layouts.master')

@section('content')
<div class="main-content-container">

    <app-trade-analysis
    :portfolios="{{$portfolios}}" 
    ></app-trade-analysis>
   
</div>

@endsection
