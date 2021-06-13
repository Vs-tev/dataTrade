<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Rules\PortfolioDateOverlapping;
use App\Http\Requests\StoreTradeRequest;
use App\Traits\StoreImgTraits;

class TradeHistoryController extends Controller
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
        return view('dashboardpages.trading.trade_history');
    }

    public function tradehistoryTradesTable(Request $request){
    
        $trades = Trade::with(['portfolio', 'strategy', 'used_entry_rules.entry_rule', 'exit_reason', 'balance', 'tradePerformance'])
        ->where([
            ['user_id', auth()->id()],
            ['portfolio_id', $request->portfolio_id],
        ])
        ->when($request->time_frame, function($query) use($request){
            $query->whereIn('time_frame', $request->time_frame);
        })
        ->when($request->start_date, function($query) use($request){
            $query->where('exit_date', '>=' , $request->start_date);
        })
        ->when($request->end_date, function($query) use($request){
            $query->where('exit_date', '<=' ,$request->end_date);
        })
        ->when($request->end_date, function($query) use($request){
            $query->where('exit_date', '<=' ,$request->end_date);
        })
        ->when($request->sort_pl == 'Winners', function($query) use($request){
            $query->where('pl_currency', '>=', 0);
        })
        ->when($request->sort_pl == 'Losers', function($query) use($request){
            $query->where('pl_currency', '<', 0);
        })
        ->when($request->search_symbol !== "", function($query) use($request){
            $query->where('symbol', 'LIKE', '%'. $request->search_symbol. '%');
        })
        ->when($request->column[0] ?? null, function($query) use($request){
            $query->orderBy($request->column[0], $request->column[1]); 
        })
        ->when($request->boolean('except_trade') == true, function($query){
            $query->whereHas('balance', function($query){
                $query->where('is_except', 1);
            }); 
        })
        ->orderBy('exit_date', 'desc')
        ->paginate(10);
          
        return $trades;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update_excepted_trade(Trade $trade)
    {
        $trade->where('user_id', auth()->id())->get();
       
        if($trade->balance->is_except == 0){
            $trade->balance()->update(['is_except' => 1]);
        }else{
            $trade->balance()->update(['is_except' => 0]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTradeRequest $request, Trade $trade)
        {
            if(!$request->hasFile('trade_img')){
                $fileNameToStore = request('trade_img') == $trade->trade_img ? $trade->trade_img : 'noimage.jpg';
            }else{
                $fileNameToStore = $this->storeImg($request->file('trade_img'), 'trades');
                
                $validated = $request->validate([
                    'trade_img' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999',
                ]);
            }

            $trade->update($request->validated() + ['trade_img' => $fileNameToStore]);
            $used_entry_rules = $trade->used_entry_rules();
            $used_entry_rules->delete();

            if($request->input('entry_rule_id')){
                $trade->add_to_used_entry_rules($request->entry_rule_id);
            }

            $trade->tradePerformance()->update(['ratio' => $request->input('risk_reward')]);   

        return $trade; 
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        if($trade->trade_img !== 'noimage.jpg'){
            Storage::delete('public/trades/'.$trade->trade_img);
        }
        
        $trade->delete();
    }

    

}
