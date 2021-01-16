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
        'started_at' => 'datetime:d-M-Y',
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
        return $query->where('is_active', 1)->pluck('id'); //return only active
    }

    public function add_to_balance($portfolio){

        $this->balance()->create([
            
            'portfolio_id' => $this->id,
            'amount' => $portfolio->start_equity,
            'action_date' => $portfolio->started_at,
            'action_type' => 'start_capital',
            dd($this)
        ]);  
    }

    public function fetch_portfolio(){
        return $this->select('portfolios.id', 'name', 'start_equity', 'currency', 'is_active', 'portfolios.started_at', DB::raw('SUM(amount) as current_balance', ), )
        ->join('balances AS b', 'portfolios.id', '=', 'b.portfolio_id')
        ->where('user_id', auth()->id())
        ->groupBy('portfolios.id')
        ->latest('portfolios.started_at')
        ->get();
        
    }
    

    /* public function fetch_portfolio(){
        //working query (change config/database  'strict' => false, line:50)
       $a = DB::Select(DB::raw('SELECT id, name, current_balance, currency, start_equity, is_active, action_date FROM 
      (SELECT portfolios.id as id, portfolios.name, portfolios.start_equity, portfolios.currency, portfolios.is_active, DATE_FORMAT(portfolios.action_date, "%d %b %Y")as action_date, balances.portfolio_id,
      SUM(amount)AS current_balance
        FROM portfolios INNER JOIN balances ON portfolios.id = balances.portfolio_id WHERE user_id = '.auth()->id().'
        GROUP BY name)a'));
        return $a;

    } */

    public function equity(){
        return $this->balance()
        ->select(DB::raw('sum(amount) as total', 'portfolio_id'))
        ->where('portfolio_id', $this->id)->get();
    }

    /* public static function calculate_balance(){
        return DB::table('balances')
        ->select(DB::raw('SUM(amount) as total_balance'))
        ->groupBy('portfolio_id')
        ->get();
         
     } */
    

}
