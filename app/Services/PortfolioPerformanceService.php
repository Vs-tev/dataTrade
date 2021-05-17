<?php

namespace App\Services;

use App\Models\Portfolio;
use App\Models\Trade;
use Illuminate\Support\Facades\DB;

class PortfolioPerformanceService{

    public function PortfolioData($query, $portfolio_id){
       
        $portfolio = Portfolio::select(['portfolios.id','b.action_date','name', 'start_equity', 'currency', 'is_active', 'portfolios.started_at', 
        DB::raw('SUM(amount) as current_balance,
        COUNT(CASE WHEN action_type = "trade" THEN 1 else NULL END) as total_trades, 
        COUNT(CASE WHEN amount >= 0 AND action_type = "trade" THEN 1 else NULL END)as winning_trades, 
        COUNT(CASE WHEN amount < 0 AND action_type = "trade" THEN 1 else NULL END)as losing_trades,
        SUM(CASE WHEN action_type = "trade" THEN amount ELSE 0 END)as trade_profit'),
        'gained_pisp' => Trade::selectRaw('SUM(pl_pips)')
            //->whereColumn('user_id', '=', auth()->id())
            ->whereColumn('portfolio_id', '=', 'portfolios.id')
        ])
        ->join('balances AS b', 'portfolios.id', '=', 'b.portfolio_id')
        ->where([['user_id', auth()->id()],['is_except', 0]])
        ->when($portfolio_id ?? null, function($query) use($portfolio_id){
            $query->where('portfolios.id', $portfolio_id);   
        })
       
        ->whereIn('is_active', $query)
        ->groupBy('portfolios.id')
        ->withCasts([
            'action_date' => 'datetime:d M Y'
        ])
        ->get();


        $new = $portfolio->map(function($object){
            $object->running_total = Portfolio::runningtotal($object->id);
            $object->return_capital_investment = number_format((($object->current_balance - $object->start_equity)/$object->start_equity) * 100,2, '.','');
            $object->netProfit = number_format($object->current_balance - $object->start_equity,2, '.',' ');
            $object->current_balance = number_format($object->current_balance,2, '.',' ');
            $object->trade_profit = number_format($object->trade_profit,2, '.',' ');
            $object->gained_pisp = number_format($object->gained_pisp,2, '.',' ');
            
            return $object;
        });
        
      /*   $data = [
            mojem da si postroim object s razlichni array ili objects vytre kato api
            'portfolio' => $new,
        ]; */
        return response()->json(
             $new
        );
    
    }

}