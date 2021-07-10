<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'type_side',
        'quantity',
        'entry_price',
        'exit_price',
        'stop_loss_price',
        'time_frame',
        'entry_date',
        'exit_date',
        'pl_currency',
        'pl_pips',
        'fees',
        'trade_notes',
        'trade_img',
        'strategy_id',
        'exit_reason_id',
        'user_id',
        'portfolio_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function used_entry_rules()
    {
        return $this->hasMany(Used_entry_rules::class, 'trade_id');
    }

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function tradePerformance()
    {
        return $this->hasOne(TradePerformance::class);
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }

    public function exit_reason()
    {
        return $this->belongsTo(ExitReason::class);
    }

    protected $casts = [
        'exit_date' => 'datetime: d-M-Y H:i',
        'entry_date' => 'datetime: d-M-Y H:i',
    ];

    public function add_to_used_entry_rules($entry_rule_id)
    {
        /* $rules = $request->entry_rule_id;
        $array = explode(',', $rules);*/

        $array = Str::of($entry_rule_id)->explode(',');
        foreach ($array as $item) {
            $this->used_entry_rules()->create([
                'trade_id' => $this->id,
                'entry_rule_id' => $item,
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function add_to_balance($trade)
    {
        $this->balance()->create([
            'amount' => $trade->pl_currency,
            'action_date' => $trade->exit_date,
            'action_type' => 'trade',
            'portfolio_id' => $trade->portfolio_id,
            'trade_id' => $this->id,
        ]);
    }

    public function add_to_trade_performance($trade)
    {
        $return_avg = TradePerformance::where('portfolio_id', \App\Models\Portfolio::isactive()->first())
            ->avg('trade_return');

        $this->tradePerformance()->create([
            'trade_return' => $trade["trade_return"],
            'trade_id' => $this->id,
            'ratio' => $trade["risk_reward"],
            'pow_2' => pow(($return_avg - $trade["trade_return"]), 2),
            'portfolio_id' => \App\Models\Portfolio::isactive()->first(),
        ]);
    }

    public function scopeDurationAvg($query, $portfolio_id, $side, $compare, $period)
    {
        $query = $this->select(
            DB::raw('AVG(TIMESTAMPDIFF(MINUTE, entry_date, exit_date)) as avg_duration')
        )
            ->where('portfolio_id', $portfolio_id)
            ->when($side !== 'all' ?? null, function ($query) use ($side) {
                $query->where('type_side', $side);
            })
            ->when(!is_null($compare) ?? null, function ($query) use ($compare) {
                $query->where('pl_currency', $compare, 0);
            })
            ->when($period ?? null, function ($query) use ($period) {
                $query->where('exit_date', '>=', $period);
            })
            ->get();

        if ($query[0]->avg_duration) {
            return $query[0]->avg_duration;
        } else {
            return 0;
        }
    }
}
