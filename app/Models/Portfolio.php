<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        return $query->where([['is_active', 1], ['user_id', auth()->id()]])->pluck('id'); //return only active
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
        ->limit(100)
        ->get();
    }
    
    public function fetch_portfolio($query){
        $portfolio = $this->select('portfolios.id','b.action_date',  'name', 'start_equity', 'currency', 'is_active', 'portfolios.started_at', 
        DB::raw('SUM(amount) as current_balance,
        COUNT(CASE WHEN action_type = "trade" THEN 1 else NULL END) as total_trades, 
        COUNT(CASE WHEN amount >= 0 AND action_type = "trade" THEN 1 else NULL END)as winning_trades, 
        COUNT(CASE WHEN amount < 0 AND action_type = "trade" THEN 1 else NULL END)as losing_trades,
        SUM(CASE WHEN action_type = "trade" THEN amount ELSE 0 END)as trade_profit'))
        ->join('balances AS b', 'portfolios.id', '=', 'b.portfolio_id')
        ->where([['user_id', auth()->id()],['is_except', 0]])
        ->whereIn('is_active', $query)
        ->groupBy('portfolios.id')
        ->get();
        
        //dd(number_format($portfolio[0]->current_balance,2, '.',' '));

        $new = $portfolio->map(function($object){
        $object->running_total = Portfolio::runningtotal($object->id);
        //$object->current_balance = number_format($object->current_balance,2, '.','');
        return $object;
        });
        
      /*   $data = [
            mojem da si postroim object s razlichni array ili objects vytre kato api
            'portfolio' => $new,
        ]; */
        return response()->json(
             $new
        );
    }

}
