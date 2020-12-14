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
/* Route::view('/{path?}', 'welcome'); */ /* for React route*/

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


Route::view('/dashboardPages/portfolio', 'dashboardpages.portfolio.portfolio')->name('portfolio')->middleware('auth');
Route::get('/dashboardPages/portfolio/g', 'PortfolioController@index');
Route::post('/dashboardPages/portfolio/u/{id}', 'PortfolioController@update');
Route::post('/dashboardPages/portfolio/store', 'PortfolioController@store')->middleware('auth');
Route::post('/dashboardPages/portfolio/d/{id}', 'PortfolioController@destroy');
Route::post('/dashboardPages/portfolio/toggle_active/{id}', 'PortfolioController@toggle_is_active_portfolio')->middleware('auth');



/* Trade Record */
Route::view('/dashboardPages/traderecord', 'dashboardpages.trading.trade_record')->middleware('auth');

/* --- */


/* Trade Hstory */
Route::view('/dashboardPages/tradehistory', 'dashboardpages.trading.trade_history')->middleware('auth');
Route::get('/dashboardPages/tradehistory', function () {
    return view('dashboardpages.trading.trade_history', [
        'message' => 'Are you sure want to delete this Trade?',
        'item' => 'AUDCAD/15min'
    ]);
});
/* --- */


/**Trading rules */
Route::view('/dashboardPages/tradingrules', 'dashboardpages.trading_rules.trading_rules')->middleware('auth');
Route::get('/dashboardPages/tradingrules', function () {
    return view('dashboardpages.trading_rules.trading_rules', [
        'message' => 'Are you sure want to delete this Entry rule?',
        'item' => 'Entry Rule Name'
    ]);
});
/* --- */

/**Trading strategy */
Route::view('/dashboardPages/stragey', 'dashboardpages.strategy.strategy')->middleware('auth');
Route::get('/dashboardPages/strategy', function () {
    return view('dashboardpages.strategy.strategy', [
        'message' => 'Are you sure want to delete this Entry rule?',
        'item' => 'Strategy 1'
    ]);
});
/* --- */



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


