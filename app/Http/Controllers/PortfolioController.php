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


class PortfolioController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio'])->except('store');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('portfolios')){
            $this->validate(request() ,[
                'name' => [Rule::unique('portfolios')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),'required', 'min:2', 'max:80'],
                'start_equity' => ['required','numeric','max:99999999999'],
                'currency' => Rule::in(["EUR", "USD", "AUD", "CAD", "CHF"]),
                'started_at' => ['required','date', 'before_or_equal: '.date("Y/m/d h:i:sa").''],
            ],[
                'before_or_equal' => 'The start date cannot be in the future'
            ]);
                
            $portfolio = new Portfolio;
            $portfolio->name = $request->input('name');
            $portfolio->start_equity = $request->input('start_equity');
            $portfolio->user_id = auth()->id();
            $portfolio->currency = $request->input('currency');
            $portfolio->started_at = $request->input('started_at');
            $portfolio->is_active = $active = Portfolio::where('user_id', auth()->id())->count() == 0 ? 1 : $active = 0;
            $portfolio->save();
            $portfolio->add_to_balance($portfolio);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\portfolio  $portfolio
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
    public function update(Request $request, $id){

        $this->validate(request() ,[
            'name' => ['required','unique:portfolios,name,'.$id.'', 'string', 'min:2', 'max:80'],
            'currency' => Rule::in(["EUR", "USD", "AUD", "CAD", "CHF"]),
        ]);
        
        $data = Portfolio::findOrFail($id);
        $data->name = $request->get('name');
        $data->currency = $request->get('currency');
        $data->update($request->all());

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        if(auth()->user()->id !== $portfolio->user_id){
            return redirect('/')->with('error', 'Unauthorize Page');
        } 

        if(auth()->user()->portfolios()->count() > 1){
            $portfolio->delete();
        }

        if($portfolio->is_active == 1 ){
            Portfolio::where([
                ['id', '<>', $id],
                ['user_id', '=', auth()->id()]
                ])->limit(1)->update([
                'is_active' => 1
            ]);
        }
        
    }

    public function toggle_is_active_portfolio(Request $request, $id){     
      
        if(Portfolio::where('user_id', auth()->id())->count() > 1){
            Portfolio::where([
                ['id', $id],
                ['user_id', '=', auth()->id()]
                ])->update([
                'is_active' => request('active') 
            ]);

            if(request('active') == 1){
                Portfolio::where([
                    ['id', '<>', $id],
                    ['user_id', '=', auth()->id()]
                    ])->update([
                    'is_active' => 0
                    ]);
            }else if(request('active') == 0){
                Portfolio::where([
                    ['id', '<>', $id],
                    ['user_id', '=', auth()->id()]
                ])->limit(1)->update([
                    'is_active' => 1
                ]);
            }
        }
        
    }

}
