<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AccounterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\DistrobuterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BonusListController;
use App\Http\Controllers\BonusController;

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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('/managers', ManagerController::class);

Route::resource('/accounters', AccounterController::class);

Route::resource('/members', MemberController::class);

Route::resource('/resellers', ResellerController::class);

Route::resource('/distrobuters', DistrobuterController::class);

Route::resource('/orders', OrderController::class);

Route::get('/bonuslists/check', [App\Http\Controllers\BonusListController::class, 'check'])
     ->name('bonuslists.check');

Route::resource('/bonuslists', BonusListController::class);

Route::get('/bonuses/{bonus}/transfered', [App\Http\Controllers\BonusController::class, 'transfered'])
     ->name('bonuses.transfered');

Route::resource('/bonuses', BonusController::class);
