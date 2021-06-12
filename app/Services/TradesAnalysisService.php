<?php

namespace App\Services;

use App\Models\Balance;
use App\Models\Portfolio;
use App\Models\Trade;
use App\Models\Used_entry_rules;
use App\Traits\SetPriodTraits;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;


class TradesAnalysisService{

    use SetPriodTraits;
    
    public function TradesMonitoring($portfolio_id, $period, $side){
 
        $period = $this->setperiod($period);
       
        $tradesMonitoring = Balance::select(['balances.portfolio_id', DB::raw('
            SUM(amount) as current_balance,
            COUNT(CASE WHEN action_type = "trade" THEN 1 else NULL END) as total_trades,
            COUNT(CASE WHEN amount >= 0 AND action_type = "trade" THEN 1 else NULL END)as winning_trades, 
            COUNT(CASE WHEN amount < 0 AND action_type = "trade" THEN 1 else NULL END)as losing_trades')])
        ->where('balances.portfolio_id', $portfolio_id)
        ->when($side !== 'all' ?? null, function($query) use($side){
            $query->where('type_side', $side);
        })
        ->when($period ?? null, function($query) use($period){
            $query->whereDate('action_date','>=', $period);   
        })
        ->join('trades', 'trades.id', '=', 'balances.trade_id')
        ->get();
        
        $new = $tradesMonitoring->map(function($object) use($side, $period){
           
            $object->winrate = number_format($object->winning_trades  / ($object->total_trades !== 0 ? $object->total_trades : 1) * 100,2, '.','');
            /*Trade Duration */
            $object->duration_avg = CarbonInterval::minutes(Trade::durationAvg($object->portfolio_id, $side, null, $period))->cascade()->forHumans(['short' => true, 'join' => ', ']);
            $object->winning_duration_avg = CarbonInterval::minutes(Trade::durationAvg($object->portfolio_id, $side, '>', $period))->cascade()->forHumans(['short' => true, 'join' => ', ']); 
            $object->losing_duration_avg = CarbonInterval::minutes(Trade::durationAvg($object->portfolio_id, $side, '<', $period))->cascade()->forHumans(['short' => true, 'join' => ', ']);
            return $object;
        });

        return response()->json(
            $new
        );
    }

    public function porfit($portfolio_id, $period, $side){
       
        $period = $this->setperiod($period);

        $profit = Balance::select(['balances.portfolio_id', 'balances.id',
            DB::raw('SUM(amount) as net_profit,
            IFNULL(SUM(CASE WHEN amount > 0 AND action_type = "trade" THEN amount ELSE 0 END), 0) as gross_profit,
            IFNULL(SUM(CASE WHEN amount <= 0 AND action_type = "trade" THEN amount ELSE NULL END), 0) gross_loss,
            COUNT(CASE WHEN action_type = "trade" THEN amount ELSE NULL END) as total_trades,
            COUNT(CASE WHEN amount >= 0 AND action_type = "trade" THEN 1 else NULL END)as winning_trades,
            COUNT(CASE WHEN amount < 0 AND action_type = "trade" THEN 1 else NULL END)as losing_trades,
            AVG(trade_return)as avg_return,
            AVG(CASE WHEN trade_return < 0 THEN trade_return END)as avg_losing_return,
            AVG(CASE WHEN trade_return > 0 THEN trade_return END)as avg_winning_return,
            MAX(CASE WHEN amount > 0 THEN amount ELSE 0 END)as biggest_win, 
            MIN(CASE WHEN amount <= 0 THEN amount ELSE 0 END) as biggest_loss
            ')])
            ->where('balances.portfolio_id', $portfolio_id)
            ->when($side !== 'all' ?? null, function($query) use($side){
                $query->where('type_side', $side);
            })
            ->when($period ?? null, function($query) use($period){
                $query->whereDate('action_date','>=', $period);   
            })
            ->with('portfolio:id,currency')
            ->join('trades', 'trades.id', '=', 'balances.trade_id')
            ->join('trade_performances' , 'balances.trade_id' , '=', 'trade_performances.trade_id')
            ->get();

          // dd(Trade::durationAvg($portfolio_id, $side, '<'));

        $new = $profit->map(function($object){
            $object->profit_factor = (int)$object->gross_profit / ((int)$object->gross_loss !== 0 ? (int)$object->gross_loss : 1);
            $object->profit_factor = number_format($object->profit_factor,2, '.','');
            $object->profit_factor = $object->profit_factor < 0 ? $object->profit_factor * -1 : $object->profit_factor;
            $object->av_trade_profit = number_format($object->net_profit / ($object->total_trades !== 0 ? $object->total_trades : 1),2, '.','');
            $object->av_trade_profit = $object->av_trade_profit;
            $object->avg_winning_trade = $object->gross_profit / ($object->winning_trades !== 0 ? $object->winning_trades : 1); 
            $object->avg_winning_trade = number_format($object->avg_winning_trade,2, '.','');
            $object->avg_losing_trade = $object->gross_loss / ($object->losing_trades !== 0 ? $object->losing_trades : 1); 
            $object->avg_losing_trade = number_format($object->avg_losing_trade,2, '.','');
            $object->avg_return = number_format($object->avg_return,2, '.','');
            $object->avg_losing_return = number_format($object->avg_losing_return,2, '.','');
            $object->avg_winning_return = number_format($object->avg_winning_return,2, '.','');

            return $object;
        });

        return response()->json(
             $new
        );
    }

    public function miscelaneousStatistic($portfolio_id, $side){

        $miscelaneous = Portfolio::select('id')->where('id', $portfolio_id)
        ->withAvg('tradePerformance', 'ratio')
        ->withSum('tradePerformance', 'pow_2')
        ->withCount('tradePerformance')
        ->get();

        $new = $miscelaneous->map(function($object) use($portfolio_id){
            $object->winning_streak = Portfolio::streak($portfolio_id, '>', '<');
            $object->losing_streak = Portfolio::streak($portfolio_id, '<', '>');
            $object->trade_performance_avg_ratio = number_format($object->trade_performance_avg_ratio,2, '.','');
            $object->standart_deviation = sqrt($object->trade_performance_sum_pow_2 / ($object->trade_performance_count-1)); 
            $object->standart_deviation =  number_format($object->standart_deviation,2, '.','');

            return $object;
        });

        return response()->json(
            $new
        );

    }

    public function mostTradedSymbols($portfolio_id){
         $symbols = Trade::select(['symbol as category' , DB::raw('COUNT(symbol)as trades')])
         ->where('portfolio_id', $portfolio_id)
         ->groupBy('symbol')
         ->orderBy('trades', 'desc')
         ->limit(10)->get();

        return $symbols;
    }

    public function timeFrameFrequence($portfolio_id){
        $timeFrame = Trade::select(['time_frame as category' , DB::raw('COUNT(time_frame)as trades')])
        ->where('portfolio_id', $portfolio_id)
        ->groupBy('time_frame')
        ->orderBy('trades', 'desc')
        ->get();

       return $timeFrame;
   }

    public function tradesUsedFeatures($portfolio_id){
   
        $tradeFeature = Trade::select([ DB::raw('
        COUNT(CASE WHEN strategy_id IS NOT NULL THEN id else NULL END)as withStrategy,
        COUNT(CASE WHEN exit_reason_id IS NOT NULL THEN id else NULL END)as withExitReason'
        ),
        'entryRules' => Used_entry_rules::selectRaw('COUNT(DISTINCT(trade_id))')
        ->whereHas('trade', function (Builder $query) use($portfolio_id) {
            $query->where('portfolio_id', $portfolio_id);
        })
        ])
        ->where('portfolio_id', $portfolio_id)
        ->get();

        return $tradeFeature;

    }

}
