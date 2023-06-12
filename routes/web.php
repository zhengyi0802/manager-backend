<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AccounterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\DistrobuterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BonusListController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\ProjectSettingController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
     ->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
     ->name('home')->middleware('auth');

Route::resource('/admins', AdminController::class);

Route::resource('/managers', ManagerController::class);

Route::resource('/accounters', AccounterController::class);

Route::get('/members/{member}/upgradeR', [App\Http\Controllers\MemberController::class, 'upgradeR'])
     ->name('members.upgradeR');

Route::get('/members/{member}/upgradeD', [App\Http\Controllers\MemberController::class, 'upgradeD'])
     ->name('members.upgradeD');

Route::resource('/members', MemberController::class);

Route::resource('/resellers', ResellerController::class);

Route::get('/distrobuters/{distrobuter}/upgradeR', [App\Http\Controllers\DistrobuterController::class, 'upgradeR'])
     ->name('distrobuters.upgradeR');

Route::resource('/distrobuters', DistrobuterController::class);

Route::get('/orders/{order}/smssend', [App\Http\Controllers\OrderController::class, 'smssend'])
     ->name('orders.smssend');

Route::resource('/orders', OrderController::class);

Route::get('/bonuslists/check', [App\Http\Controllers\BonusListController::class, 'check'])
     ->name('bonuslists.check');

Route::get('/bonuslists/{bonuslist}/check', [App\Http\Controllers\BonusListController::class, 'funded'])
     ->name('bonuslists.funded');

Route::resource('/bonuslists', BonusListController::class);

Route::get('/bonuses/{bonus}/transfered', [App\Http\Controllers\BonusController::class, 'transfered'])
     ->name('bonuses.transfered');

Route::resource('/bonuses', BonusController::class);

Route::get('/projectsettings', [App\Http\Controllers\ProjectSettingController::class, 'index'])
     ->name('projectsettings.index');

Route::get('/projectsettings/{manager}/edit', [App\Http\Controllers\ProjectSettingController::class, 'edit'])
     ->name('projectsettings.edit');

Route::post('/projectsettings/{manager}/update', [App\Http\Controllers\ProjectSettingController::class, 'update'])
     ->name('projectsettings.update');
