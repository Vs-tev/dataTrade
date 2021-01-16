<?php

namespace App\Http\Controllers;


use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $trade->pl_pips = $request->input('pl_pips');
        $trade->trade_notes = $request->input('trade_notes');
        $trade->trade_img = $fileNameToStore;
        $trade->exit_reason_id = $request->input('exit_reason_id');
        //$trade->entry_rule_id = $request->input('entry_rule_id');
        $trade->strategy_id = $request->input('strategy_id');
        $trade->portfolio_id = \App\Models\Portfolio::isactive()->first();
        $trade->user_id = auth()->id();        
        dd($request->input('entry_rule_id'));
        $trade->save();
        $trade->add_to_used_entry_rules($request);//ot tuk schte vzema portfolio_id, trade id

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
