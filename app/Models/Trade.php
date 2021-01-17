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

    public function used_entry_rules(){
        return $this->hasMany(Used_entry_rules::class);
    }

    public function balance(){
        return $this->hasOne(Balance::class);
    }

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
