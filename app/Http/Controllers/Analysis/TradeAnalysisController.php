<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Services\PortfolioPerformanceService;

class TradeAnalysisController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','hasPortfolio']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('trade_analysis.trade_analysis');
       
    }

    public function portfolioData($portfolio_id){
        
        $is_active = [0 , 1];

        $portfolio = (new PortfolioPerformanceService())->PortfolioData($is_active, $portfolio_id);

        return $portfolio;

    }
}
