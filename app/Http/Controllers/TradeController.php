<?php

namespace App\Http\Controllers;


use App\Models\Trade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\PortfolioDateOverlapping;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return view('dashboardpages.trading.trade_record');
        
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
            'type_side' => ['required', Rule::in(['buy', 'sell'])],
            'quantity' => ['required', 'numeric','min:0','max:99999999999'],
            'symbol' => 'required',
            'entry_price' => ['required', 'numeric','min:0','max:99999999999'],
            'exit_price' => ['required', 'numeric','min:0','max:99999999999'],
            'stop_loss_price' => ['required', 'numeric','min:0','max:99999999999'],
            'time_frame' => Rule::in(['1 min', '5 min', '15 min', '30 min', '1 hour', '2 hours', '4 hours', '1 day', '1 week', '1 month']),
            'entry_date' => ['required', 'date',  new PortfolioDateOverlapping, 'before_or_equal: '.date("Y/m/d h:i:sa").''],
            'exit_date' => ['required', 'date', 'after_or_equal: '.$request->input('entry_date').''],
            'pl_currency' => ['required', 'numeric','min:-99999999999','max:99999999999'],
            'pl_pips' => ['required', 'numeric','min:-99999999','max:99999999'],
            'fees' => ['nullable', 'numeric','min:-99999999','max:99999999'],
            'exit_reason_id' => 'exists:App\Models\ExitReason,id',
            'strategy_id' => 'exists:App\Models\Strategy,id',
            'trade_img' => ['nullable', 'image','dimensions:min_width=200,min_height=200'],
            'trade_notes' => ['nullable','max:10000'],
        ],[
            'before_or_equal' => 'Entry date cannot be in the future'
        ]);

        if(request()->hasFile('trade_img')){
            //Get filename with extention
            $filenameWithExt = request()->file('trade_img')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $extention = request()->file('trade_img')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Upload Image
            $path = request()->file('trade_img')->storeAs('public/trades', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }

        $trade = new Trade;
        $trade->symbol = $request->input('symbol');
        $trade->type_side = $request->input('type_side');
        $trade->quantity = $request->input('quantity');
        $trade->entry_price = $request->input('entry_price');
        $trade->exit_price = $request->input('exit_price');
        $trade->stop_loss_price = $request->input('stop_loss_price');
        $trade->time_frame = $request->input('time_frame');
        $trade->entry_date = $request->input('entry_date');
        $trade->exit_date = $request->input('exit_date');
        $trade->pl_currency = $request->input('pl_currency');
        $trade->fees = $request->input('fees');
        $trade->pl_pips = $request->input('pl_pips');
        $trade->trade_notes = $request->input('trade_notes');
        $trade->trade_img = $fileNameToStore;
        $trade->exit_reason_id = $request->input('exit_reason_id');
        //$trade->entry_rule_id = $request->input('entry_rule_id');
        $trade->strategy_id = $request->input('strategy_id');
        $trade->portfolio_id = \App\Models\Portfolio::isactive()->first();
        $trade->user_id = auth()->id();        

        $trade->save();
        $trade->add_to_balance($trade);
        if($request->input('entry_rule_id')){
            $trade->add_to_used_entry_rules($request);//ot tuk schte vzema portfolio_id, trade id
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }
}
