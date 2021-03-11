@extends('layouts.master')

@section('content')

<div class="main-content-container">
  
    @if (session('message'))
    <div class="alert bg-primary alert-top col-12 m-auto text-center  content-container alert-dismissible">
        <button type="button" class="close mt-1 font-xxl font-weight-light white" data-dismiss="alert">&times;</button>
        <div>{{session('message')}}</div>
    </div>
    @else 
        @if (session('cancel'))
            <div class="alert bg-danger alert-top col-12 m-auto text-center  content-container alert-dismissible">
                <button type="button" class="close mt-1 font-xxl font-weight-light white" data-dismiss="alert">&times;</button>
                <div class="text-center">{{session('cancel')}}</div>
            </div>
       
    @else
        @if (empty($currentplan->stripe_id) || !$subscriptionstatus)
            <div class="alert bg-primary alert-top col-12 m-auto text-center  content-container alert-dismissible">
                <button type="button" class="close mt-1 font-xxl font-weight-light white" data-dismiss="alert">&times;</button>
                <div class="text-center">Your are now on free plan. Upgrade with a few clicks.</div>
            </div>
        @endif
    @endif
    @endif
    
    
    <div class="content-container py-0 mt-4">

       <app-plans 
       :monthly_plans="{{$monthlyPlans}}" 
       :yearly_plans="{{$yearlyPlans}}"
       @if ($subscriptionstatus)
       :subscriptionstatus="{{$subscriptionstatus}}"
       @endif
       
        @if (!is_null($currentplan))
        :currentplan="{{$currentplan}}"
        @if ($currentplan->onGracePeriod())
            :on_grace_period="{{$currentplan->onGracePeriod()}}"
        @endif
        @endif
        ></app-plans>
        
    </div>  
   
</div>
@endsection