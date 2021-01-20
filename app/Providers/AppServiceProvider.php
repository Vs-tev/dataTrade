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
       /*  test how to send data to vue component in traderecord
        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('trade', \App\Models\Trade::all());
        }); */

        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('strategy', \App\Models\Strategy::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('exitReasons', \App\Models\ExitReason::where('user_id', auth()->id())->get());
        });

        View::composer(['dashboardpages.trading.trade_record'], function($view){
            $view->with('entryRules', \App\Models\EntryRules::where('user_id', auth()->id())->get());
        });
    }
}
