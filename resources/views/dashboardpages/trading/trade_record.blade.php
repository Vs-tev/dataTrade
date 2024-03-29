@extends('layouts.master')

@section('content')

<div class="main-content-container">
    <div id="VueTradeRecord" class="trade-record-container d-flex-row d-md-flex">
        <div class="col-12 col-md-8 col-lg-9">
            <app-traderecord 
                :strategies="{{$strategy}}" 
                :exit_reason="{{$exitReasons}}" 
                :entryrules="{{$entryRules}}">
            </app-traderecord>
        </div>
    <div class="col-12 col-md-4 col-lg-3">
        <section class="dashboard_container_content p-0">
            <app-traderecord-chart-table></app-traderecord-chart-table>
        </section>
    </div>

    </div>

</div>
@endsection
