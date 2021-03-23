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

Route::view('typography','typography.typography' )->name('tests');


Route::get('/', function () {
    return view('auth.login');
});

/* Reset Password */
Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');


/* User settings */
Route::get('/user_settings', 'UserController@index')->name('user_settings');
Route::post('/user_settings/u/{id}', 'UserController@update');
Route::post('/user_settings/password/', 'UserController@changePassword');
/*  */

Route::get('/create_first_portfolio', function () {
    return Auth::user()->portfolios()->count() == 0 ? view('auth.first_portfolio') : back();
})->name('first_portfolio')->middleware('auth');

/* dashboard */
Route::get('/dashboardPages/dashboard', 'HomeController@index')->name('dashboard');

//portfolio actions
Route::group(['middleware,' => 'auth', 'prefix' => 'dashboardPages'], function(){
    Route::get('/portfolio', 'PortfolioController@view_portfolio')->name('portfolio');
    Route::get('/portfolio/g', 'PortfolioController@index');
    Route::get('/portfolioIsActive/g', 'PortfolioController@show');
    Route::post('/portfolio/u/{id}', 'PortfolioController@update');
    Route::get('/portfolio/create', 'PortfolioController@create');
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
    Route::get('/', 'TradeController@index')->name('trade_record');
    Route::post('/p', 'TradeController@store');
    Route::get('/t', 'TradeController@tradeRecordTradesTable');
});


/* Trade Hstory */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/tradehistory'], function(){
    Route::get('/', 'TradeHistoryController@index')->name('trade_history');
    Route::get('/g', 'TradeHistoryController@tradehistoryTradesTable');
    Route::post('/u/{id}', 'TradeHistoryController@update');
    Route::post('/exept/{id}', 'TradeHistoryController@update_excepted_trade');
    Route::post('/d/{id}', 'TradeHistoryController@destroy');
});

/* Trading rules */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/tradingrules'], function(){
    Route::view('/', 'dashboardpages.trading_rules.trading_rules')->name('trading_rules');
    Route::get('/entry_rules/g', 'EntryRulesController@index');
    Route::get('/exit_reasons/g', 'ExitReasonController@index');
    Route::get('/exit_reasons', 'ExitReasonController@create');
    Route::get('/entry_rules', 'EntryRulesController@create');
    Route::post('/entry_rules/p', 'EntryRulesController@store');
    Route::post('/exit_reasons/p', 'ExitReasonController@store');
    Route::post('/entry_rules/u/{id}', 'EntryRulesController@update');
    Route::post('/exit_reasons/u/{id}', 'ExitReasonController@update');
    Route::post('/entry_rules/d/{id}', 'EntryRulesController@destroy');
    Route::post('/exit_reasons/d/{id}', 'ExitReasonController@destroy');
});

/* Trading strategy */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboardPages/strategy'], function(){
    Route::view('/', 'dashboardpages.strategy.strategy')->middleware('auth')->name('strategy');
    Route::get('/g', 'StrategyController@index');
    Route::get('/create', 'StrategyController@create');
    Route::post('/p', 'StrategyController@store');
    Route::post('/u/{id}', 'StrategyController@update');
    Route::post('/d/{id}', 'StrategyController@destroy');
});

/* Balance Controller */
Route::get('/dashboardPages/traderecord/sparkline', 'BalanceController@getSparklineRuningTotal');

/**Plans*/
Route::group(['middleware' => 'auth'],  function(){
    Route::get('/plan', 'BillingController@index')->middleware('auth')->name('plan');
    Route::get('/checkout/{plan_id}', 'CheckoutController@checkout')->name('checkout');
    Route::post('/checkout', 'CheckoutController@processCheckout')->name('checkout.process');
    Route::get('/cancel', 'BillingController@cancel')->name('cancels');
    Route::get('/resume/{plan_id}', 'BillingController@resume')->name('resume');
    Route::get('/payment_methods_all', 'PaymentMethodController@index')->name('payment_methods');
    Route::get('/payment_methods_all/dashboard', 'BillingController@dashboard')->name('payment_methods.dashboard');

    Route::get('payment-methods/default/{method_id}', 'PaymentMethodController@markDefault')->name('payment-methods.markDefault');
    Route::get('payment-methods/delete/{id}', 'PaymentMethodController@destroy')->name('payment-methods.destroy');

    Route::resource('payment_methods', 'PaymentMethodController');

});

Route::get('/symbols', 'SymbolController@index')->name('symbol');


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


