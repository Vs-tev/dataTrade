<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Balance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class PortfolioController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolio = new Portfolio;

        return $portfolio->fetch_portfolio();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request() ,[
            'name' => ['required','unique:portfolios', 'string', 'min:2', 'max:80'],
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

        //return response()->json($portfolio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(portfolio $portfolio)
    {
        //
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
      
        $portfolio->delete();
  
    }

    public function toggle_is_active_portfolio(Request $request, $id){     
      
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
    
        //return $data;
    }

    public function transactions(){
        
    }

}
