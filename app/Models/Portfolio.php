<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_equity',
        'currency',
        'action_date',
        'user_id',
        'is_active'
    ];

    protected $dates = ['action_date'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function balance(){
        return $this->hasMany(Balance::class);
    }

    public static function portfolioDate($id){
    
       return static::find($id)->action_date->format('d M Y');   //start date Portfolio

    }

    protected $appends=['published'];
    public function getPublishedAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['action_date']))->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]); 
        //this bind published with getPublishedAttribute() and return 'created_at' with diffForHumans(). used in vue to output readable date 
    }
    
    public function scopeIsactive($query){
        return $query->where('is_active', 1); //return only active
    }

    public function add_to_balance($portfolio){
        $this->balance()->create([
            'portfolio_id' => $this->id,
            'amount' => $portfolio->start_equity,
            'action_date' => $portfolio->action_date,
            'action_type' => 'start_capital'
        ]);  

        
    }
    public function calculate_balance(){
        $a = $this->balance()->sum('amount');
        dd($a);
    }

}
