<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Portfolio;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   


        /**Trade History*/
        View::composer(['dashboardpages.trading.trade_history'], function($view){
            $view->with('portfolios', \App\Models\Portfolio::where('user_id', auth()->id())
            ->orderBy('is_active', 'DESC')
            ->get());
        });

        View::composer(['dashboardpages.trading.trade_history'], function($view){
            $view->with('strategy', \App\Models\Strategy::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_history'], function($view){
            $view->with('exitReasons', \App\Models\ExitReason::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_history'], function($view){
            $view->with('entryRules', \App\Models\EntryRules::where('user_id', auth()->id())->get());
        });


        /**Trade Record*/
        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('strategy', \App\Models\Strategy::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('exitReasons', \App\Models\ExitReason::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('entryRules', \App\Models\EntryRules::where('user_id', auth()->id())->get());
        });

        /* Countries */
        View::composer(['auth.user-settings'], function($view){
            $view->with('countries', \App\Models\Country::all());
        });

         /* Plan */
         View::composer(['billing.dashboard', 'layouts.navbar'], function($view){
            $view->with('plan',  $plan = \App\Models\Plan::where('stripe_plan_id',  auth()->user()->subscribed('default') == true ? auth()->user()->subscription('default')->stripe_plan : \App\Models\Plan::free_plan_price_id()->first())->first()
        );
        });

    }
}
