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
        'action_date' => 'datetime:d-M-Y',
    ];

    public function portfolio(){
        return $this->belongsTo(Portfolio::class);
    }

    public function runningTotal(){
        return $this->select('action_date', DB::raw('SUM(amount) OVER(ORDER BY action_date)as running_total'))
        ->where('portfolio_id', \App\Models\Portfolio::isactive()->first())
        ->get()
        ->toJson();
    }

}
