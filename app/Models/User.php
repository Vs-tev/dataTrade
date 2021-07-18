<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'postcode',
        'is_notifiable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'allowed_amount_trades',
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function strategies()
    {
        return $this->hasMany(Strategy::class);
    }

    public function entry_rules()
    {
        return $this->hasMany(EntryRules::class);
    }

    public function exit_reasons()
    {
        return $this->hasMany(ExitReason::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    /* public function plan(){
        return $this->belongsTo(Plan::class);
    } */
    public function getAllowedAmountTradesAttribute()
    {
        if (Auth::check()) {


            $subscriptionstatus = auth()->user()->subscribed('default');

            return Feature::select('feature_plan.max_amount')
                ->join('feature_plan', 'feature_plan.feature_id', '=', 'features.id')
                ->join('plans', 'feature_plan.plan_id', '=', 'plans.id')
                ->where([
                    ['plans.stripe_plan_id', $subscriptionstatus == true ? auth()->user()->subscription('default')->stripe_plan : Plan::free_plan_price_id()->first()],
                    ['features.name', '=', 'trades']
                ])
                ->groupBy('features.name')
                ->first();
        }
    }
}
