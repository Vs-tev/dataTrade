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
        $this->middleware('auth');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'amount_transaction' => ['required','numeric','max:99999999999', ],
            'transaction_date' => ['required', new PortfolioDateOverlapping]
        ]);
      
        if (Auth::check()) {
            $transaction = new Balance;
            $transaction->portfolio_id = $request->input('portfolio_id');
            $transaction->amount = $request->input('amount_transaction');
            $transaction->action_date = $request->input('transaction_date');
            $transaction->action_type = 'transaction';
            
            $transaction->save();
        }else{
            return route('login'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
