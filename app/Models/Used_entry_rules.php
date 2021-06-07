<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Used_entry_rules extends Model
{

    use HasFactory;

    protected $fillable = ['entry_rule_id', 'trade_id', 'user_id'];

   /*  public function trade(){
        return $this->belongsTo(Trade::class);
    } */

    public function entry_rule(){
        return $this->belongsTo(EntryRules::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function trade(){
        return $this->belongsTo(Trade::class);
    }

    
}
