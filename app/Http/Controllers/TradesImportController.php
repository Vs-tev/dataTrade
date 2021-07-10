<?php

namespace App\Http\Controllers;

use App\Imports\TradesImport;
use App\Models\User;
use App\Notifications\CatchImportErrorsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $user = User::where('id', auth()->id())->first();
        $import = new TradesImport($request->input('portfolio'), $user);
        Excel::import($import, $file);
        return back()->with('message', 'The trades uploading is processing. We will inform when the trades are completly imported.');
    }

    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();

        return response()->noContent();
    }
}
