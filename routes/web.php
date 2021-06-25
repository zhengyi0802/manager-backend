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
use App\Http\Controllers\AppMenuController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\BulletinItemController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\QACatagoryController;
use App\Http\Controllers\QAListController;
use App\Http\Controllers\CustomerSupportController;
use App\Http\Controllers\ELearningCatagoryController;
use App\Http\Controllers\ELearningController;
use App\Http\Controllers\ChangePasswordController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/admin/settings', function() {
    return view('admin.settings');
})->name('settings');

Route::get('/admin/profile', function() {
    return view('admin.profile');
})->name('profile');

Route::get('admin/change_password', [App\Http\Controllers\ChangePasswordController::class, 'index']);

Route::post('admin/change_password', [App\Http\Controllers\ChangePasswordController::class, 'store'])->name('change.password');

Route::resource('/product_catagories', ProductCatagoryController::class);

Route::resource('/product_types', ProductTypeController::class);

Route::resource('/product_statuses', ProductStatusController::class);

Route::get('/products/query', [App\Http\Controllers\ProductController::class, 'query'])
       ->name('products.query');

Route::get('/products/register', [App\Http\Controllers\ProductController::class, 'register'])
       ->name('products.register');

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

Route::get('/appmenus/query', [App\Http\Controllers\AppMenuController::class, 'query'])
       ->name('appmenus.query');

Route::resource('/appmenus', AppMenuController::class);

Route::get('/bulletins/query', [App\Http\Controllers\BulletinController::class, 'query'])
       ->name('bulletins.query');

Route::resource('/bulletins', BulletinController::class);

Route::resource('/bulletinitems', BulletinItemController::class);

Route::get('/marquees/query', [App\Http\Controllers\MarqueeController::class, 'query'])
       ->name('marquees.query');

Route::resource('/marquees', MarqueeController::class);

Route::get('/qacatagories/query', [App\Http\Controllers\QACatagoryController::class, 'query'])
       ->name('qacatagories.query');

Route::resource('/qacatagories', QACatagoryController::class);

Route::get('/qalists/query', [App\Http\Controllers\QAListController::class, 'query'])
       ->name('qalists.query');

Route::get('/qalists/queryall', [App\Http\Controllers\QAListController::class, 'queryall'])
       ->name('qalists.queryall');

Route::resource('/qalists', QAListController::class);

Route::get('/customersupports/query', [App\Http\Controllers\CustomerSupportController::class, 'query'])
       ->name('customersupports.query');

Route::resource('customersupports', CustomerSupportController::class);

Route::get('elearningcatagories/query', [App\Http\Controllers\ELearningCatagoryController::class, 'query'])
       ->name('elearningcatagories.query');

Route::resource('/elearningcatagories', ELearningCatagoryController::class);

Route::get('elearnings/query', [App\Http\Controllers\ELearningController::class, 'query'])
       ->name('elearnings.query');

Route::resource('/elearnings', ELearningController::class);

Route::get('/packages/query', [App\Http\Controllers\PackageController::class, 'query'])
       ->name('packages.query');

Route::resource('/packages', PackageController::class);

Route::resource('/managers', ManagerController::class);

Route::resource('/resellers', ResellerController::class);

Route::resource('/members', MemberController::class);

