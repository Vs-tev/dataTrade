<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Feature;
use App\Models\Payment;
use Illuminate\Http\Request;


class BillingController extends Controller
{

    public function index()
    {

        $monthlyPlans = Plan::where('billing_period', 'monthly')->get();
        $yearlyPlans = Plan::where('billing_period', 'yearly')->get();
        $currentplan = auth()->user()->subscription('default') ?? NULL;
        $subscriptionstatus = auth()->user()->subscribed('default');
        $paymentMethods = auth()->user()->paymentMethods();
       
        if(!is_null($currentplan)){
            $currentplan->withCasts(['ends_at' => 'datetime:d M Y']);
        }
        $payments = Payment::where('user_id', auth()->id())->latest()->get();

        return view('billing.index', compact('monthlyPlans', 'yearlyPlans', 'currentplan', 'paymentMethods', 'subscriptionstatus', 'payments'));
    }

    public function cancel()
    {
        $cancel = auth()->user()->subscription('default')->cancel();
        return redirect()->route('plan')->with('cancel', 'Your cancellation was successfully');
    }

    public function resume($plan_id)
    {
        
        $paymentMethods = auth()->user()->paymentMethods();
        if($paymentMethods->count()){
            $resume = auth()->user()->subscription('default')->resume();
            return redirect()->route('plan')->withMessage('Subscribed successfully');
        }else{
            $plan = Plan::findOrFail($plan_id);
            $intent = auth()->user()->createSetupIntent();
            return view('billing.checkout', compact('plan', 'intent'));
        }
    }

    public function dashboard()
    {
        $subscriptionstatus = auth()->user()->subscribed('default');
      
        //$plan = Plan::where('stripe_plan_id',  $subscriptionstatus == true ? auth()->user()->subscription('default')->stripe_plan : Plan::free_plan_price_id()->first())->get();
        
        $userFeatures = Feature::select('features.name', 'feature_plan.max_amount')
        ->join('feature_plan', 'feature_plan.feature_id', '=', 'features.id')
        ->join('plans', 'feature_plan.plan_id', '=', 'plans.id')
        ->where('plans.stripe_plan_id', $subscriptionstatus == true ? auth()->user()->subscription('default')->stripe_plan : Plan::free_plan_price_id()->first())
        ->groupBy('features.name')
        ->orderBy('feature_plan.max_amount', 'ASC')
        ->get();
      
        return view('billing.dashboard', compact('userFeatures'));
    }

    public function downloadInvoice($paymentId){
        $payment = Payment::where('user_id', auth()->id())->where('id', $paymentId)->firstOrFail();
        $filename = storage_path('app/invoices/' . $payment->user_id . '.pdf');
        if(!file_exists($filename)){
            abort(404);
        }
        return response()->download($filename);
    }

}

