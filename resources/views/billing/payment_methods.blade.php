@extends('layouts.master')

@section('content')

<div class="main-content-container">

    <div class="content-container">
        @if (Session('error'))
        <div class="alert alert-danger">{{session('error') }}</div>
    @endif
       <div class="dashboard_container_content col-12 col-md-9 m-auto p-0 ">
          <div class="d-flex align-items-center border-bottom p-4">
              <a href="{{ route('plan') }}" class="pointer mr-2 " title="back">
                  <span class="material-icons primary">arrow_back</span>
              </a> 
              <h4> Payment methods</h4>
          </div>
      
            <div class="p-4">
           
              <div class="d-flex align-items-center">
                  <a href="" data-target="#modal-payment-method" data-toggle="modal" class="btn btn-secondary border-0 lighter font-500 mb-2">
                      Add creditcard
                  </a>
                </div>    
              
                
               
                <table class="table table-sm table-hover">
                    <thead>
                        <tr class="">
                            <th>Brand</th>
                            <th>Card</th>
                            <th>Expires</th>
                            <th>Card holder</th>
                            <th></th>
                            <th>Delete card</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentMethods as $paymentMethod)
                        <tr class="">
                            <td class="text-muted font-500">{{$paymentMethod->card->brand}}</td>
                            <td class="font-500">****{{$paymentMethod->card->last4}}</td>
                            <td class="font-500">{{$paymentMethod->card->exp_month}}/{{$paymentMethod->card->exp_year}}</td>
                            <td class="font-500">{{$paymentMethod->billing_details->name}}</td>
                            <td class="font-500">
                                @if ($defaultPaymentMethod->id == $paymentMethod->id)
                                    <div class="font-500">default</div>
                                
                                  </div> 
                                @else 
                                    <a href="{{route('payment-methods.markDefault', $paymentMethod->id)}}">Marke as default</a>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('payment-methods.destroy', $paymentMethod->id) }}" class="btn">
                                        <span class="material-icons">delete</span>
                                    </a>
                                </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            
            </div>
       </div>
    </div>  
   
</div>
 {{-- modal payment method --}}
 <div class="modal" id="modal-payment-method">        
    <div class="modal-dialog modal-dialog-centered">
        <div  class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add credit card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-icons ml-auto close-btn icon-sm" >close</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('payment_methods.store')}}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="payment-method" id="payment-method" value="" />
        
                    <!-- Stripe Elements Placeholder -->
                    <label>Card number</label>
                    <div id="card-element" class=""></div>
                    <p class="error-output pt-0"></p>
                    
                    <div class="mt-5">
                      <label>Card holder name</label>
                      <input id="card-holder-name" class="StripeElement" type="text" placeholder="Card holder name">
                    </div>

                    <div class="custom-control custom-checkbox mt-4 mb-4">
                        <input type="checkbox" value="1" class="custom-control-input" id="default" name="default" checked>
                        <label class="custom-control-label" for="default">Mark as default</label>
                    </div>
                    <button id="card-button" class="btn btn-primary ml-auto mt-4">Add card</button>
                </form>
            </div>

        </div>
    </div>
 </div>
 {{-- end modal payment method --}}
@endsection
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
    <script>
      $( document ).ready(function() {
        let stripe = Stripe("{{ env('STRIPE_KEY') }}")
        let elements = stripe.elements()
        let style = {
          base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
              color: '#aab7c4'
            }
          },
          invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
          }
        }
        let card = elements.create('card', {style: style})
        card.mount('#card-element')
        let paymentMethod = null
        $('#checkout-form').on('submit', function (e) {
          if (paymentMethod) {
            return true
          }
          stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
              payment_method: {
                card: card,
                billing_details: {name: $('#card-holder-name').val()}
              }
            }
          ).then(function (result) {
            if (result.error) {
              $('.error-output').text(result.error.message);
            } else {
              paymentMethod = result.setupIntent.payment_method
              $('#payment-method').val(paymentMethod)
              $('#checkout-form').submit()
            }
          })
          return false
        })
      });
    </script>
@endsection