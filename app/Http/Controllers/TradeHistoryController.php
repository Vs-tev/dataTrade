<?php

namespace App\Http\Controllers;

use App\Exports\TradesExport;
use Illuminate\Http\Request;
use App\Models\Trade;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTradeRequest;
use App\Models\Portfolio;
use App\Services\TradeHistoryService;
use App\Traits\StoreImgTraits;

class TradeHistoryController extends Controller
{
    use StoreImgTraits;

    public function __construct()
    {
        $this->middleware(['auth', 'hasPortfolio']);
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

    public function tradehistoryTradesTable(Request $request)
    {
        return (new TradeHistoryService())->tradeHistoryTable($request);
    }

    public function export(Portfolio $portfolio)
    {
        // dd($portfolio->id);
        if ($portfolio->user_id == auth()->id()) {
            return (new TradesExport($portfolio->id))->download('invoices.xlsx');
        } else {
            abort(403);
        }
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

        if ($trade->balance->is_except == 0) {
            $trade->balance()->update(['is_except' => 1]);
        } else {
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
        if (!$request->hasFile('trade_img')) {
            $fileNameToStore = request('trade_img') == $trade->trade_img ? $trade->trade_img : 'noimage.jpg';
        } else {
            $fileNameToStore = $this->storeImg($request->file('trade_img'), 'trades');

            $validated = $request->validate([
                'trade_img' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:2999',
            ]);
        }

        $trade->update($request->validated() + ['trade_img' => $fileNameToStore]);
        $used_entry_rules = $trade->used_entry_rules();
        $used_entry_rules->delete();

        if ($request->input('entry_rule_id')) {
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
        if ($trade->trade_img !== 'noimage.jpg') {
            Storage::delete('public/trades/' . $trade->trade_img);
        }

        $trade->delete();
    }
}
