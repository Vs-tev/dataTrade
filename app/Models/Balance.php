<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'amount',
        'action_date',
        'action_type',
    ];

    protected $casts = [
        'action_date' => 'datetime:Y-m-d H:i',
    ];

    public function portfolio(){
        return $this->belongsTo(Portfolio::class);
    }

    public function tradePerformance(){
        return $this->hasOne(TradePerformance::class, 'trade_id', 'trade_id');
    }

    public function trades(){
        return $this->belongsTo(Trade::class);
    }

    public function runningTotalSparkline(){
        return $this->select('action_date' , DB::raw('SUM(amount) OVER(ORDER BY action_date)as running_total'))
        ->where([['portfolio_id', \App\Models\Portfolio::isactive()->first()], ['is_except', 0]])
        ->when(\App\Models\Balance::where('portfolio_id', \App\Models\Portfolio::isactive()->first())->count() > 300 ?? null, function($query){
            $query->groupBy(DB::raw("DAY(action_date)"));
            //$query->limit(50);
        })
        ->orderBy('action_date', 'DESC')
        ->limit(100)
        ->get();
    }
}
