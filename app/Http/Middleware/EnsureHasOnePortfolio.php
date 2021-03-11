<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class EnsureHasOnePortfolio
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
        //dd(Auth::user()->portfolios()->count());

        if(Auth::user()->portfolios()->count() == 0){
            return redirect()->route('first_portfolio');
        }

        return $next($request);
    }
}
