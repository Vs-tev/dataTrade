<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
    'trade_img',
    'symbol',
    'type_side',
    'quantity',
    'entry_price',
    'exit_price',
    'stop_loss_price',
    'time_frame',
    'entry_date',
    'exit_date',
    'trade_notes',
    'trade_img',
    'strategy',
    'exit_reason'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function used_entry_rules(){
        return $this->hasMany(Used_entry_rules::class);
    }

    public function balance(){
        return $this->hasOne(Balance::class);
    }

    public function portfolio(){
        return $this->belongsTo(Portfolio::class);
    }

    public function strategy(){
        return $this->belongsTo(Strategy::class);
    }

    public function exit_reason(){
        return $this->belongsTo(ExitReason::class);
    }

    protected $casts = [
        'exit_date' => 'datetime: d-M-Y H:i',
        'entry_date' => 'datetime: d-M-Y H:i',
    ];

    public function add_to_used_entry_rules($request){
        /* $rules = $request->entry_rule_id;
        $array = explode(',', $rules);*/     
        
        $array = Str::of($request->entry_rule_id)->explode(',');
        foreach($array as $item){
            $this->used_entry_rules()->create([
                'trade_id' => $this->id,
                'entry_rule_id' => $item,
                'user_id' => auth()->id(),
            ]);  
        }
    }

    public function add_to_balance($trade){

        $this->balance()->create([
            'amount' => $trade->pl_currency,
            'action_date' => $trade->exit_date,
            'action_type' => 'trade',
            'portfolio_id' => $trade->portfolio_id,
            'trade_id' => $this->id,
        ]);
    }
}
