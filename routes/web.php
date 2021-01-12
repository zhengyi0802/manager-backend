<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCatagoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProjectController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/admin/settings', function() {
    return view('admin.settings');
})->name('settings');

Route::get('/frontend_views', function() {
    return view('frontend_views.template');
})->name('frontend');

Route::resource('/product_catagories', ProductCatagoryController::class);

Route::resource('/product_types', ProductTypeController::class);

Route::resource('/projects', ProjectController::class);
