<?php

namespace App\Http\Controllers;

use App\Imports\TradesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreTradeRequest;

class TradesImportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hasPortfolio']);
    }

    public function index()
    {
        return view('dashboardpages.trading.trades_import');
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        // $import = Excel::import(new TradesImport, $file);
        try {
            Excel::import(new TradesImport($request->input('portfolio')), $file);
        } catch (\ValidationException $e) {
            return back()->withErrors($e);
        }


        return back()->withStatus('Excel file imported successfully');
    }
}
