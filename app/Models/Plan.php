<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'stripe_plan_id', 'plan_description','billing_period'];

    public function features(){
        return $this->belongsToMany(Feature::class)->withPivot(['max_amount']);
    }

    public function scopeFree_plan_price_id(){
        return $this->where('name', 'Free')->pluck('stripe_plan_id');
    }
}
