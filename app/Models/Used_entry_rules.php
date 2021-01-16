<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Used_entry_rules extends Model
{

    use HasFactory;
    protected $fillable = ['entry_rule_id', 'trade_id', 'user_id'];

    /* public function entry_rule(){
        return $this->belongsTo(EntryRules::class);
    } */

    public function trade(){
        return $this->belongsTo(Trade::class);
    }
    
}
