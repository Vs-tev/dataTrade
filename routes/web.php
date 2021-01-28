<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::view('typography','typography.typography' );

//////////////////////////Route::view('/example', 'example'); 
Route::get('/example', function () {
    return view('example', [
        'info' => 'Very bla bla bla'
    ]);
});

Route::get('/example', function () {
    return view('example', [
        'cardname' => 'card-name for page 1',
        'cardtext' => 'Some example text some example text. John Doe is an architect and engineer Page 1',
        'button' => 'button1',
    ]);
});
Route::get('/example2', function () {
    return view('example', [
        'cardname' => 'card-name for page 2',
        'cardtext' => 'Some example text some example text. John Doe is an architect and engineer Page 2',
        'button' => 'button2',
    ]);
});
/////////////////////////////////////////////end example

Route::view('/dashboardPages/dashboard', 'dashboardpages.dashboard');

//portfolio actions
Route::view('/dashboardPages/portfolio', 'dashboardpages.portfolio.portfolio')->name('portfolio')->middleware('auth');
Route::get('/dashboardPages/portfolio/g', 'PortfolioController@index');
Route::get('/dashboardPages/portfolioIsActive/g', 'PortfolioController@show');
Route::post('/dashboardPages/portfolio/u/{id}', 'PortfolioController@update');
Route::post('/dashboardPages/portfolio/store', 'PortfolioController@store');
Route::post('/dashboardPages/portfolio/d/{id}', 'PortfolioController@destroy');
Route::post('/dashboardPages/portfolio/toggle_active/{id}', 'PortfolioController@toggle_is_active_portfolio');

//transactions
Route::get('/dashboardPages/portfolio/getTransactions/{id}', 'TransactionsController@index');
Route::post('/dashboardPages/portfolio/storeTransactions', 'TransactionsController@store');
Route::post('/dashboardPages/portfolio/deleteTransactions/{id}', 'TransactionsController@destroy');


/* Trade Record */
Route::view('/dashboardPages/traderecord', 'dashboardpages.trading.trade_record')->middleware('auth');
Route::get('/dashboardPages/traderecord', 'TradeController@index')->middleware('auth');

Route::get('/dashboardPages/traderecord/sparkline', 'TradeController@runningtotal');

Route::post('/dashboardPages/traderecord/p', 'TradeController@store');
/* --- */


/* Trade Hstory */
Route::view('/dashboardPages/tradehistory', 'dashboardpages.trading.trade_history')->middleware('auth');

/* --- */


/**Trading rules */
Route::view('/dashboardPages/tradingrules', 'dashboardpages.trading_rules.trading_rules')->middleware('auth');
Route::get('/entry_rules/g', 'EntryRulesController@index');
Route::get('/exit_reasons/g', 'ExitReasonController@index');
Route::post('/dashboardPages/tradingrules/entry_rules/p', 'EntryRulesController@store');
Route::post('/dashboardPages/tradingrules/exit_reasons/p', 'ExitReasonController@store');
Route::post('/dashboardPages/tradingrules/entry_rules/u/{id}', 'EntryRulesController@update');
Route::post('/dashboardPages/tradingrules/exit_reasons/u/{id}', 'ExitReasonController@update');
Route::post('/dashboardPages/tradingrules/entry_rules/d/{id}', 'EntryRulesController@destroy');
Route::post('/dashboardPages/tradingrules/exit_reasons/d/{id}', 'ExitReasonController@destroy');



/* --- */

/**Trading strategy */
Route::view('/dashboardPages/strategy', 'dashboardpages.strategy.strategy')->middleware('auth');
Route::get('/strategy/g', 'StrategyController@index');
Route::post('/strategy/p', 'StrategyController@store');
Route::post('/strategy/u/{id}', 'StrategyController@update');
Route::post('/strategy/d/{id}', 'StrategyController@destroy');
/* --- */



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


