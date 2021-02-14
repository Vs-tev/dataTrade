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



Route::view('typography','typography.typography' );

Route::get('/', function () {
    return view('auth.login');
});

Route::view('/dashboardPages/dashboard', 'dashboardpages.dashboard');

//portfolio actions
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages'], function(){
    Route::view('/portfolio', 'dashboardpages.portfolio.portfolio')->name('portfolio');
    Route::get('/portfolio/g', 'PortfolioController@index');
    Route::get('/portfolioIsActive/g', 'PortfolioController@show');
    Route::post('/portfolio/u/{id}', 'PortfolioController@update');
    Route::post('/portfolio/store', 'PortfolioController@store');
    Route::post('/portfolio/d/{id}', 'PortfolioController@destroy');
    Route::post('/portfolio/toggle_active/{id}', 'PortfolioController@toggle_is_active_portfolio');
});

//transactions
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/portfolio'], function(){
    Route::get('/getTransactions/{id}', 'TransactionsController@index');
    Route::post('/storeTransactions', 'TransactionsController@store');
    Route::post('/deleteTransactions/{id}', 'TransactionsController@destroy');
});

/* Trade Record */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/traderecord'], function(){
    Route::view('/', 'dashboardpages.trading.trade_record');
    Route::get('/', 'TradeController@index')->middleware('auth');
    Route::post('/p', 'TradeController@store');
    Route::get('/t', 'TradeController@tradeRecordTradesTable');
});


/* Trade Hstory */
Route::view('/dashboardPages/tradehistory', 'dashboardpages.trading.trade_history')->middleware('auth');
Route::get('/dashboardPages/tradehistory/g', 'TradeController@tradehistoryTradesTable');
Route::post('/dashboardPages/tradehistory/u/{id}', 'TradeController@update');
Route::post('/dashboardPages/tradehistory/d/{id}', 'TradeController@destroy');


/* Trading rules */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/tradingrules'], function(){
    Route::view('/', 'dashboardpages.trading_rules.trading_rules');
    Route::get('/entry_rules/g', 'EntryRulesController@index');
    Route::get('/exit_reasons/g', 'ExitReasonController@index');
    Route::post('/entry_rules/p', 'EntryRulesController@store');
    Route::post('/exit_reasons/p', 'ExitReasonController@store');
    Route::post('/entry_rules/u/{id}', 'EntryRulesController@update');
    Route::post('/exit_reasons/u/{id}', 'ExitReasonController@update');
    Route::post('/entry_rules/d/{id}', 'EntryRulesController@destroy');
    Route::post('/exit_reasons/d/{id}', 'ExitReasonController@destroy');
});

/* Trading strategy */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/strategy'], function(){
    Route::view('/', 'dashboardpages.strategy.strategy')->middleware('auth');
    Route::get('/g', 'StrategyController@index');
    Route::post('/p', 'StrategyController@store');
    Route::post('/u/{id}', 'StrategyController@update');
    Route::post('/d/{id}', 'StrategyController@destroy');
});

/* Balance Controller */
Route::get('/dashboardPages/traderecord/sparkline', 'BalanceController@getSparklineRuningTotal');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


