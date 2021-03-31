<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
   public function checkout($plan_id)
   {

       $plan = Plan::findOrFail($plan_id);
       $currentplan = auth()->user()->subscription('default')->stripe_id ?? NULL;
    
       if(!is_null($currentplan) && $currentplan !== $plan->stripe_plan_id && auth()->user()->paymentMethods()->count()){
            auth()->user()->subscription('default')->swap($plan->stripe_plan_id);
            return redirect()->back()->withMessage('Plan changed successfully');
       }
      
       $intent = auth()->user()->createSetupIntent();
       return view('billing.checkout', compact('plan', 'intent'));
   }

   public function processCheckout(Request $request){

        $plan = Plan::findOrFail($request->input('billing_plan_id'));

        //Before go ahead with subscription we delete the row form table "subscriptions" with the free subscription
        $free_subscription = auth()->user()->subscription();
        $free_subscription->delete();
       
        try{
            auth()->user()->newSubscription('default', $plan->stripe_plan_id)->create($request->input('payment-method'));
            auth()->user()->update([
                'country' => $request->input('country'),
                'postcode' => $request->input('postcode')
            ]);
            return redirect()->route('plan')->withMessage('Subscribed successfully');
        }catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
   }
}
