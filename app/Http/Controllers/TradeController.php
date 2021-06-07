<?php

namespace App\Http\Controllers;


use App\Models\Trade;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\PortfolioDateOverlapping;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTradeRequest;
use App\Traits\StoreImgTraits;

class TradeController extends Controller
{

    use StoreImgTraits;

    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboardpages.trading.trade_record');
    }

    public function tradeRecordTradesTable(){
        $trade = new Trade;
        $trade = $trade->select('symbol', 'exit_date', 'pl_currency')
        ->where([
            ['portfolio_id', \App\Models\Portfolio::isactive()->first()],
            ['user_id', auth()->id()]
            ])
        ->orderBy('exit_date', 'DESC')
        ->limit(5)
        ->get();
        return $trade;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTradeRequest $request)
    {
    
        if (Gate::allows('trades')) {
           
            $fileNameToStore = $this->storeImg($request->file('trade_img'), 'trades');
            
            $trade = Trade::create([
                'user_id' => auth()->id(),
                'trade_img' => $fileNameToStore,
                'portfolio_id' => \App\Models\Portfolio::isactive()->first(),
            ] + $request->validated());

            //$trade_performance = $request->all();

            $trade->add_to_balance($trade); 
            $trade->add_to_trade_performance($request->all());
    
            if($request->input('entry_rule_id')){
                $trade->add_to_used_entry_rules($request->entry_rule_id);
            }
        } else {
            return response('Upgrade account', 402);     
        }
    }

 
}
