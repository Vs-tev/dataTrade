<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Feature;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       //This middleware is register in Kernel Group where is checked for all pages. 

        if (auth()->check()) {
            $subscriptionstatus = auth()->user()->subscribed('default'); //here we check the subscription status true/false

            //$parent_user_id = auth()->user()->user_id ?? auth()->id();
            $userFeatures = Feature::select('features.name', 'feature_plan.max_amount')
                ->join('feature_plan', 'feature_plan.feature_id', '=', 'features.id')
                ->join('plans', 'feature_plan.plan_id', '=', 'plans.id')
                ->join('subscriptions', 'plans.stripe_plan_id', '=', 'subscriptions.stripe_plan')
                ->where('plans.stripe_plan_id', $subscriptionstatus == true ? auth()->user()->subscription('default')->stripe_plan : \App\Models\Plan::free_plan_price_id()->first())
                ->where(function($query) {
                    return $query->whereNull('subscriptions.ends_at')
                        ->orWhere('subscriptions.ends_at', '>', now()->toDateTimeString());
                })
               ->get();
           
            foreach ($userFeatures as $feature) {
             
                if (!is_null($feature->max_amount)) {
                    Gate::define($feature->name, function () use ($feature) {
                        $method = $feature->name;
                        if (!method_exists(auth()->user(), $method)) {
                            return true;
                        }
                        return auth()->user()->{$method}()->count() < $feature->max_amount;
                    });
                }
            }
        }
        return $next($request);
    }
}
