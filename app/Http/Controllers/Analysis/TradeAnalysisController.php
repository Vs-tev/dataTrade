<?php

namespace App\Http\Controllers\Analysis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

use App\Services\PortfolioPerformanceService;
use App\Services\TradesAnalysisService;

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

    public function tradesMonitoring($portfolio_id, $period, $side){
       
       $tradeMonitoring = (new TradesAnalysisService())->TradesMonitoring($portfolio_id, $period, $side);

       return $tradeMonitoring;

    }

    public function profit($portfolio_id, $period, $side){
       
        //dd($portfolio_id, $period, $side);

        $profit = (new TradesAnalysisService())->porfit($portfolio_id, $period, $side);
 
        return $profit;
 
    }

    public function miscelaneous($portfolio_id, $side){

        $profit = (new TradesAnalysisService())->miscelaneousStatistic($portfolio_id, $side);

        return $profit;

    }

    public function mostTradedSymbols($portfolio_id){

        $mostTradedSymbols = (new TradesAnalysisService())->mostTradedSymbols($portfolio_id);

        return $mostTradedSymbols;

    }

    public function timeFrameFrequence($portfolio_id){

        $timeFrame = (new TradesAnalysisService())->timeFrameFrequence($portfolio_id);

        return $timeFrame;

    }
}
