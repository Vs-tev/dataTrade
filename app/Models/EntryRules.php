<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryRules extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public function used_entry_rules(){
        return $this->hasMany(Used_entry_rules::class, 'entry_rule_id');
    }

    //since the tables "entry_rules" and "trades" has no relationship 
    //we use hasManyThrough with class Used_entry_rules::class to connect both models 
    public function trade(){
        return $this->hasManyThrough(Trade::class, Used_entry_rules::class, 'entry_rule_id', 'id', 'id', 'trade_id');
    }

}
