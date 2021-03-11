@extends('layouts.master')

@section('content')

<div class="main-content-container">
    
    <div class="content-container py-0 pl-5">
        <div class="row mt-4">
            <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                <h3 class="mb-4">Current Plan</h3>
                <div class="mb-4">
                    <h1 class="ml-4 mb-0 display-4 text-uppercase primary">{{$plan[0]->name}}</h1>
                    
                    <h6 class="ml-4 font-weight-light lighter text-uppercase">{{$plan[0]->name == 'Free' ? 'forever' : $plan[0]->billing_period }}</h6>
                </div>
                <div class="mb-4">
                    <ul class="list-unstyled">
                        @foreach ($userFeatures as $item)
                        <li class="d-flex justify-content-between py-3 font-lg"> 
                            <div class="font-500 text-capitalize ">{{str_replace("_", " ",$item->name)}}</div> 
                            <div> <span class="font-500 dark">{{auth()->user()->{$item->name}()->count()}}</span> / <span>{{$max = $item->max_amount == 999999 ? 'unlimited' : $item->max_amount}}</span></div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <a href="{{route('plan')}}" class="btn btn-primary font-lg">Upgrade Plan</a>
            </div>
            <div class="col-12 col-md-8 col-lg-9 col-xl-10 text-center">
                <h3 class="mb-4">Payment Method</h3>
                <a href="{{route('payment_methods')}}" class="btn btn-success m-auto font-lg w-15">Add Credit Card</a>
            </div>
        </div>

        {{-- @can('portfolios')
            <p>Mojem da syzdatem portfolios</p>
        @else 
            <P>ne moam portfolios</P>
        @endcan

        @can('strategies')
            <p>Mojem da napraim strategies</p>
        @else 
            <P>ne moam strategies</P>
        @endcan

        @can('entry_rules')
            <p>Mojem da napraim entry_rules</p>
        @else 
            <P>ne moam entry_rules</P>
        @endcan

        @can('exit_reasons')
            <p>Mojem da exit_reasons</p>
        @else 
            <P>ne moam exit_reasons</P>
        @endcan

        @can('trades')
            <p>Mojem da zapishem trades</p>
        @else 
            <P>ne moam trades</P>
        @endcan
 --}}
        

    </div>  
   
</div>
@endsection