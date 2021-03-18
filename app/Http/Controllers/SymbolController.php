<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symbol;

class SymbolController extends Controller
{
    public function index(Request $request){
        
        if($request->type !== 'all'){
            return $symbol = Symbol::where([
                ['type', $request->type],
                ['symbol', 'LIKE', '%' .$request->search_symbol. '%']
                ])->get();  
        }else{
            return Symbol::where('symbol', 'LIKE', '%' .$request->search_symbol. '%')->get();  
        }
        
    }
}
