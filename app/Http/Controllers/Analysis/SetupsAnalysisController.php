<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetupsAnalysisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio']);
    }

    public function index()
    {
        return view('setups_analysis.trading_setups_analysis');
       
    }
}
