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
    
    
    <div class="content-container py-0 pt-4 pb-5">

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

        <div class="dashboard_container_content col-12 col-md-9 mt-5 mb-5 mx-auto p-0 ">
            <div class="d-flex align-items-center border-bottom p-4">
                <h4 class="mb-0">Receipts</h4>
            </div>
              <div class="px-4 pt-2 pb-4">
                  <table class="table table-sm table-hover">
                      <thead>
                          <tr class="">
                              <th>Payment date</th>
                              <th>Amount</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($payments as $payment)
                          <tr class="">
                                <td class="font-500">{{$payment->created_at->format('d F Y')}}</td>
                                <td class="font-500">€{{number_format($payment->total / 100, 2)}}</td>
                                <td><a href="{{route('invoices.download', $payment->id)}}" class="font-500">Download Receipt</a></td> 
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              
              </div>
         </div>
        
    </div>  
   
</div>
@endsection