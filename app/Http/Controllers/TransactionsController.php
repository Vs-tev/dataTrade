<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Balance;
use App\Models\Portfolio;
use App\Rules\PortfolioDateOverlapping;
class TransactionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio']);
    }
     
    public function index($id)
    {
        $transaction = Balance::select('id','amount', 'action_date')->where([
            ['portfolio_id',$id],
            ['action_type', 'transaction']
            ])->orderBy('action_date', 'desc')->paginate(25);
            
        $transaction->onEachSide(1)->links();
        return  response()->json($transaction);
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request() ,[
            'amount' => ['required','numeric','max:99999999999', ],
            'action_date' => ['required', new PortfolioDateOverlapping]
        ]);
      
        Balance::create($request->all() + ['action_type' => 'transaction']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Balance::find($id);
        $transaction->delete();
    }
}
