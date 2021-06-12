<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\Services\PortfolioPerformanceService;
use App\Http\Requests\StorePortfolioRequest;


class PortfolioController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('hasPortfolio')->except('store');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view_portfolio()
    {
       return view('dashboardpages.portfolio.portfolio');
    }

    public function index()
    {
        $is_active = [0, 1];

        $portfolio = (new PortfolioPerformanceService())->PortfolioData($is_active, []);
       
        return $portfolio;
    }


    public function create()
    {
        if (!Gate::allows('portfolios')) {
            return response('Upgrade account', 402);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     *  @param  \App\Http\Requests\StorePortfolioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePortfolioRequest $request)
    {
        if (Gate::allows('portfolios')){
            
            $portfolio = Portfolio::create([
                'user_id' => auth()->id(),
                'is_active' => $active = Portfolio::where('user_id', auth()->id())->count() == 0 ? 1 : $active = 0,
            ] + $request->validated());

            $portfolio->add_to_balance($portfolio);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $is_active = [1];
        $portfolio = (new PortfolioPerformanceService())->PortfolioData($is_active, []);

        return $portfolio;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(StorePortfolioRequest $request, Portfolio $portfolio)
    {
        $portfolio->update($request->validated());

        return $portfolio;
    }



    public function clear(Portfolio $portfolio)
    {
        $portfolio->balance()->where('action_type', 'transaction')->delete();
        $portfolio->trades()->delete();
    }
   
    public function destroy(Portfolio $portfolio)
    {
        if(auth()->user()->portfolios()->count() > 1){
            $portfolio->delete();
            $portfolio->balance()->delete();
            $portfolio->trades()->delete();



            if($portfolio->is_active == 1){
                Portfolio::where([
                    ['id', '<>', $portfolio->id],
                    ['user_id', '=', auth()->id()]
                    ])->limit(1)->update([
                    'is_active' => 1
                ]);
            }
        }else{
           return abort(403, 'This portfolio cannot be deleted');
        }
    }

    public function restore($id)
    {   
        $portfolio = Portfolio::where([['id', $id],['user_id', auth()->id()]])
        ->withTrashed()->first();
        $portfolio->restore();
        $portfolio->balance()->restore();
        $portfolio->trades()->restore();
    }

    public function forceDelete()    
    {
        Portfolio::where('id', $id)->forceDelete();

    }
    

    public function toggle_is_active_portfolio(Request $request, Portfolio $portfolio)
    {     
        if(Portfolio::where('user_id', auth()->id())->count() > 1){
            Portfolio::where([
                ['id', $portfolio->id],
                ['user_id', '=', auth()->id()]
                ])->update([
                'is_active' => request('active') 
            ]);

            if(request('active') == 1){
                Portfolio::where([
                    ['id', '<>', $portfolio->id],
                    ['user_id', '=', auth()->id()]
                    ])->update([
                    'is_active' => 0
                    ]);
            }else{
                Portfolio::where([
                    ['id', '<>', $portfolio->id],
                    ['user_id', '=', auth()->id()]
                ])->limit(1)->update([
                    'is_active' => 1
                ]);
            }
        }
        
    }

}
