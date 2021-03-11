@extends('layouts.master')

@section('content')

<div class="main-content-container">

   

    <div class="content-container">
        @if (session('error'))
        <div class="alert alert-info">{{ session('error') }}</div>
        @endif
       <div class="dashboard_container_content col-12 col-md-9 m-auto p-0 ">
        <div class="row m-0">
            <div class="col-12 col-md-5 p-4 bg-light">
                <h2>Your Order</h2>
                <br>
                <div class="d-flex justify-content-between font-lg">
                    <div class="lighter">{{$plan->name}} <span class="font-sm font-500 text-capitalize">({{$plan->billing_period}})</span></div>
                    <div class="font-weight-500">Eur {{ number_format($plan->price / 100, 2) }}</div>
                    
                </div>
                <hr>
                    <div class="d-flex justify-content-between font-weight-bold font-xl">
                        <div>Total:</div>
                        <div>Eur {{ number_format($plan->price / 100, 2) }}</div>
                    </div>
            </div>
            <div class="col-12 col-md-7 py-4 px-5">
                    <div class="d-flex align-items-center">
                      <a href="{{ route('plan') }}" class="pointer mr-2 " title="back">
                        <span class="material-icons primary">arrow_back</span>
                      </a>  
                        <h2> Payment Inforamtion</h2>
                    </div>
                   
                <br>
                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
                    <input type="hidden" name="payment-method" id="payment-method" value="" />
        
                    <!-- Stripe Elements Placeholder -->
                    <div class="mb-4">
                      <label>Card number</label>
                      <div id="card-element" class=""></div>
                      <p class="error-output"></p>
                    </div>
                   
                   <div class="mb-4">
                    <label>Card holder name</label>
                    <br>
                    <input id="card-holder-name" class="StripeElement" type="text" placeholder="Card holder name" required>
                   </div>
                   
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                           <label>Country</label>
                           <br>
                            <select name="country_id" class="StripeElement">
                                <option value="Germany">Germany</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label>Postcode</label>
                            <br>
                            <input type="text" name="postcote" class="StripeElement" placeholder="Postcode" required>
                        </div>
                       
                    </div>
                    
                    <button id="card-button" class="btn btn-primary btn-lg font-lg ml-auto mt-4">Subscribe</button>
                    </div>

                </form>
            </div>
            
        </div>
      
       </div>
    </div>  
   
</div>
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
              console.log(result);
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
