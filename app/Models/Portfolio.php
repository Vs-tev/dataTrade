<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['name, currency'];

    protected $casts = [
        'started_at' => 'datetime:d M Y',
    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function balance(){
        return $this->hasMany(Balance::class);
    }

    public function tradePerformance(){
        return $this->hasMany(TradePerformance::class);
    }

    public static function portfolioDate($id){
       return static::find($id)->started_at->format('d M Y');   
       //fetch for the validation message start date Portfolio
    }

    
    /* protected $appends=['published'];
    public function getPublishedAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['action_date']))->diffForHumans(['options' => Carbon::ONE_DAY_WORDS]); 
        //this bind published with getPublishedAttribute() and return 'created_at' with diffForHumans(). used in vue to output readable date 
    } */

    public function scopeIsactive($query){
        return $query->where([
            ['is_active', 1], 
            ['user_id', auth()->id()]
        ])->pluck('id'); //return only active
    }

    public function add_to_balance($portfolio){
        $this->balance()->create([
            'portfolio_id' => $this->id,
            'amount' => $portfolio->start_equity,
            'action_date' => $portfolio->started_at,
            'action_type' => 'start_capital',
        ]);  
    }

    public function scopeRunningTotal($query, $id){

        //running total for all portfolios used in portfolio page
         return $query = DB::table('balances')->select('action_date', 'id' , DB::raw('SUM(amount) OVER(ORDER BY action_date)as running_total'))
        ->where([['portfolio_id', $id],['is_except', 0]])
        ->orderBy('action_date', 'DESC')
        ->when(\App\Models\Balance::where('portfolio_id', $id)->count() > 300 ?? null, function($query){
            $query->groupBy(DB::raw("DAY(action_date)"));
            //$query->limit(50);
        })
        ->get();
    }

    public function scopeStreak($query, $portfolio_id, $sign, $sign1){
        
        $operetor = $sign;
        $operetor1 = $sign1;
        
        $query = DB::select(" 
        SELECT IFNULL(MAX(count), 0)as win_streak FROM (SELECT portfolio_id, trade_id, COUNT(*) AS count FROM 
        (SELECT *,
        SUM(CASE WHEN amount {$operetor1} 0 THEN 1 END) OVER (PARTITION BY portfolio_id ORDER BY action_date, trade_id ROWS UNBOUNDED PRECEDING) AS streak FROM balances)as dt 
        WHERE action_type = 'trade' and amount {$operetor} 0 and portfolio_id = :id GROUP by streak)as dt
        ",[ ":id" => $portfolio_id]);

        return $query[0]->win_streak;       
    }
    
}
