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

    public function runningTotalSparkline(){
        return $this->select('action_date' , DB::raw('SUM(amount) OVER(ORDER BY action_date)as running_total'))
        ->where('portfolio_id', \App\Models\Portfolio::isactive()->first())
        ->orderBy('action_date', 'DESC')
        ->limit(100)
        ->get();
        
        /* SELECT * FROM (SELECT action_date, amount, SUM(amount) OVER(ORDER BY action_date) as running 
               From balances WHERE portfolio_id = 3)t */
    }

}
