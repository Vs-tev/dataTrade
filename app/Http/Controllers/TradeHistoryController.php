<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Rules\PortfolioDateOverlapping;

class TradeHistoryController extends Controller
{

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
        
        $trades = new Trade;

        if($request->start_date !== null){
            $trades = $trades->where('exit_date', '>=' , $request->start_date);
        }
        if($request->end_date !== null){
            $trades = $trades->where('exit_date', '<=' ,$request->end_date);
        }
        if($request->time_frame){
            $trades = $trades->whereIn('time_frame', $request->time_frame);
        }
        if($request->sort_pl == 'Winners'){
            $trades = $trades->where('pl_currency', '>=', 0);
        }else if($request->sort_pl == 'Losers'){
            $trades = $trades->where('pl_currency', '<', 0);
        };

        if($request->search_symbol !== ""){
            $trades = $trades->where('symbol', 'LIKE', '%'. $request->search_symbol. '%');
        };
        if($request->column[0] !== null){
            $trades = $trades->orderBy($request->column[0], $request->column[1]);
        };

        if($request->boolean('except_trade') == true){
            $trades->whereHas('balance', function($query){
                $query->where('is_except', 1);
            }); 
        }

        $trades = $trades->with(['portfolio', 'strategy', 'used_entry_rules.entry_rule', 'exit_reason', 'balance', 'trade_performance'])
        ->where([
            ['user_id', auth()->id()],
            ['portfolio_id', $request->p_id],
        ])
        ->orderBy('exit_date', 'desc')
        ->paginate(request()->display);

        return $trades;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update_excepted_trade(Trade $trade, $id)
    {
        $trade = Trade::where('user_id', auth()->id())->find($id);
       
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
    public function update(Request $request, $id)
        {
        $this->validate(request() ,[
            'type_side' => ['required', Rule::in(['buy', 'sell'])],
            'quantity' => ['required', 'numeric','min:0','max:99999999999'],
            'symbol' => ['required', 'exists:App\Models\Symbol,symbol'],
            'entry_price' => ['required', 'numeric','min:0','max:99999999999'],
            'exit_price' => ['required', 'numeric','min:0','max:99999999999'],
            'stop_loss_price' => ['required', 'numeric','min:0','max:99999999999'],
            'time_frame' => Rule::in(['1 min', '5 min', '15 min', '30 min', '1 hour', '2 hours', '4 hours', '1 day', '1 week', '1 month']),
            //'entry_date' => ['required', 'date',  new PortfolioDateOverlapping, 'before_or_equal: '.date("Y/m/d h:i:sa").''],
            //'exit_date' => ['required', 'date', 'after_or_equal: '.$request->input('entry_date').''],
            'exit_reason_id' => 'exists:App\Models\ExitReason,id',
            'strategy_id' => 'exists:App\Models\Strategy,id',
            'trade_notes' => ['nullable','max:10000'],
        ]);

        $trade = Trade::findOrFail($id);

        $trade->symbol = $request->input('symbol');
        $trade->type_side = $request->input('type_side');
        $trade->quantity = $request->input('quantity');
        $trade->entry_price = $request->input('entry_price');
        $trade->exit_price = $request->input('exit_price');
        $trade->stop_loss_price = $request->input('stop_loss_price');
        $trade->time_frame = $request->input('time_frame');
        $trade->trade_notes = $request->input('trade_notes');
        $trade->strategy_id = $request->input('strategy_id');
        $trade->exit_reason_id = $request->input('exit_reason_id');
        $used_entry_rules = $trade->used_entry_rules();
        $used_entry_rules->delete();

        $trade->trade_performance()->update(['ratio' => $request->input('risk_reward')]);   

        if($request->input('entry_rule_id')){
            $trade->add_to_used_entry_rules($request);
        }
        
        if(request('trade_img') == $trade->trade_img){
            $fileNameToStore = $trade->trade_img;
        }else{
            if(request()->hasFile('trade_img')){
            $this->validate(request() ,[
                'trade_img' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999'
            ],
            ['trade_img.image' => 'Allowed file types: jpg,png,gif']
            );
             $filenameWithExt = request()->file('trade_img')->getClientOriginalName();
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             $extention = request()->file('trade_img')->getClientOriginalExtension();
             $fileNameToStore = $filename.'_'.time().'.'.$extention;
             $path = request()->file('trade_img')->storeAs('public/trades', $fileNameToStore);
             if($trade->trade_img !== 'noimage.jpg'){
                Storage::delete('public/trades/'.$trade->trade_img);
            }
            }else {
                $fileNameToStore = 'noimage.jpg';
                if($trade->trade_img !== 'noimage.jpg'){
                    Storage::delete('public/trades/'.$trade->trade_img);
                }
            }
        }
        $trade->trade_img = $fileNameToStore;

        $trade->save();

        return $trade;
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trade = Trade::find($id);
        if($trade->trade_img !== 'noimage.jpg'){
            Storage::delete('public/trades/'.$trade->trade_img);
        }

        $trade->delete();
    }

}
