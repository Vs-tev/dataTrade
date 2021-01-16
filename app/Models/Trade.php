<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trade extends Model
{
    use HasFactory;

    public function used_entry_rules(){
        return $this->hasMany(Used_entry_rules::class);
    }

    public function add_to_used_entry_rules($request){
        foreach((array)$request->entry_rule_id as $rule){
            dd((array)$request->entry_rule_id);
            $this->used_entry_rules()->create([
                'trade_id' => $this->id,
                'entry_rule_id' => $rule,
                'user_id' => auth()->id(),
            ]);  
        }
    }
}
