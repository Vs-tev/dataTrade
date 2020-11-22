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
    return view('welcome');
});

Route::view('typography','typography.typography' );

//Route::view('/example', 'example'); 
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
//end example


Route::view('/dashboardPages/portfolio', 'dashboardpages.portfolio.portfolio');
Route::get('/dashboardPages/portfolio', function () {
    return view('dashboardpages.portfolio.portfolio', [
        'message' => 'Are you sure want to delete this Portfolio',
        
    ]);
});
Route::view('/dashboardPages/dashboard', 'dashboardpages.dashboard');

/* Trade Record */
Route::view('/dashboardPages/traderecord', 'dashboardpages.trading.trade_record');

/* --- */


/* Trade Hstori */
Route::view('/dashboardPages/tradehistory', 'dashboardpages.trading.trade_history');
Route::get('/dashboardPages/tradehistory', function () {
    return view('dashboardpages.trading.trade_history', [
        'message' => 'Are you sure want to delete this Trade?',
    ]);
});
/* --- */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
