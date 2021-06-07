<?php

namespace App\Http\Controllers;
use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    public function getSparklineRuningTotal()
    {
        $balance = new Balance;
    
        return $balance->runningTotalSparkline();
    }

    
}
