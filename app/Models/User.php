<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function portfolios(){
        return $this->hasMany(Portfolio::class);
    }

    public function strategies(){
        return $this->hasMany(Strategy::class);
    }

    public function entry_rules(){
        return $this->hasMany(EntryRules::class);
    }

    public function exit_reasons(){
        return $this->hasMany(ExitReason::class);
    }

    public function trades(){
        return $this->hasMany(Trade::class);
    }

}
