<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradePerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_return', 'ratio', 'pow_2', 'portfolio_id'
    ];

    public function portfolio(){
        return $this->belongsTo(Portfolio::class);
    }

    public function trades(){
        return $this->belongsTo(Trade::class);
    }

}
