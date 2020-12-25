<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

 public function fetch_portfolio(){
        return $this->portfolio()->where('portfolio_id', $this->id);
    }

}
