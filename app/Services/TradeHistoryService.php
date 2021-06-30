<?php

namespace App\Services;

use App\Models\Trade;

class TradeHistoryService
{
    public function tradeHistoryTable($trade)
    {
        return Trade::with([
            'portfolio:id,name',
            'strategy:id,name',
            'used_entry_rules.entry_rule',
            'exit_reason:id,name',
            'balance:id,trade_id,is_except',
            'tradePerformance:id,trade_id,trade_return,ratio'
        ])
            ->where([
                ['user_id', auth()->id()],
                ['portfolio_id', $trade["portfolio_id"]],
            ])
            ->when($trade->time_frame, function ($query) use ($trade) {
                $query->whereIn('time_frame', $trade->time_frame);
            })
            ->when($trade->start_date, function ($query) use ($trade) {
                $query->where('exit_date', '>=', $trade->start_date);
            })
            ->when($trade->end_date, function ($query) use ($trade) {
                $query->where('exit_date', '<=', $trade->end_date);
            })
            ->when($trade->end_date, function ($query) use ($trade) {
                $query->where('exit_date', '<=', $trade->end_date);
            })
            ->when($trade->sort_pl == 'Winners', function ($query) use ($trade) {
                $query->where('pl_currency', '>=', 0);
            })
            ->when($trade->sort_pl == 'Losers', function ($query) use ($trade) {
                $query->where('pl_currency', '<', 0);
            })
            ->when($trade->search_symbol !== "", function ($query) use ($trade) {
                $query->where('symbol', 'LIKE', '%' . $trade->search_symbol . '%');
            })
            ->when($trade->column[0] ?? null, function ($query) use ($trade) {
                $query->orderBy($trade->column[0], $trade->column[1]);
            })
            ->when($trade->boolean('except_trade') == true, function ($query) {
                $query->whereHas('balance', function ($query) {
                    $query->where('is_except', 1);
                });
            })
            ->orderBy('exit_date', 'desc')
            ->paginate($trade->display);
    }
}
