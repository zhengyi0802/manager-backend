<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCatagoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\FrontendViewController;

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


Route::resource('/product_catagories', ProductCatagoryController::class);

Route::resource('/product_types', ProductTypeController::class);

Route::resource('/product_statuses', ProductStatusController::class);

Route::resource('/products', ProductController::class);

Route::resource('/projects', ProjectController::class);

Route::get('/materials/{project}/{position}/edit2', [App\Http\Controllers\MaterialController::class, 'edit2'])
       ->name('materials.edit2');

Route::get('/marerials/{project}/{position}/creat2', [App\Http\Controllers\MaterialController::class, 'create2'])
       ->name('materials.create2');

Route::post('/materials/{project}/{position}/store2', [App\Http\Controllers\MaterialController::class, 'store2'])
       ->name('materials.store2');

Route::resource('/materials', MaterialController::class);

Route::get('/startpages/query', [App\Http\Controllers\StartpageController::class, 'query'])
       ->name('startpages.query');

Route::resource('/startpages', StartpageController::class);

Route::get('/frontend_views', [App\Http\Controllers\FrontendViewController::class, 'index'])
       ->name('frontend_views.index');

Route::get('/frontend_views/query', [App\Http\Controllers\FrontendViewController::class, 'query'])
       ->name('frontend_views.query');

Route::get('/frontend_views/{project}/edit', [App\Http\Controllers\FrontendViewController::class, 'edit'])
       ->name('frontend_views.edit');
