<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductCatagoryController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductStatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LogMessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\MainVideoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StartpageController;
use App\Http\Controllers\FrontendViewController;
use App\Http\Controllers\AppMenuController;
use App\Http\Controllers\AppAdvertisingController;
use App\Http\Controllers\VoiceSettingController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\BulletinItemController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ApkManagerController;
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

Route::post('/logmessages/savelog', [App\Http\Controllers\LogMessageController::class, 'savelog'])
       ->name('logmessages.savelog');

Route::resource('/logmessages', LogMessageController::class);

Route::resource('/projects', ProjectController::class);

Route::get('/logos/{project}/edit2', [App\Http\Controllers\LogoController::class, 'edit2'])
       ->name('logos.edit2');

Route::get('/logos/{project}/create2', [App\Http\Controllers\LogoController::class, 'create2'])
       ->name('logos.create2');

Route::get('/logos/{project}/query', [App\Http\Controllers\LogoController::class, 'query'])
       ->name('logos.query');

Route::post('/logos/{project}/{logo}/store2', [App\Http\Controllers\LogoController::class, 'store2'])
       ->name('logos.store2');

Route::resource('/logos', LogoController::class);

Route::get('/materials/{project}/{position}/edit2', [App\Http\Controllers\MaterialController::class, 'edit2'])
       ->name('materials.edit2');

Route::get('/marerials/{project}/{position}/creat2', [App\Http\Controllers\MaterialController::class, 'create2'])
       ->name('materials.create2');

Route::post('/materials/{project}/{position}/{material}/store2', [App\Http\Controllers\MaterialController::class, 'store2'])
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

Route::get('/businesses/{project}/create2', [App\Http\Controllers\BusinessController::class, 'create2'])
       ->name('businesses.create2');

Route::get('/businesses/{project}/edit2', [App\Http\Controllers\BusinessController::class, 'edit2'])
       ->name('businesses.edit2');

Route::get('/businesses/query', [App\Http\Controllers\BusinessController::class, 'query'])
       ->name('businesses.query');

Route::post('/businesses/{project}/{business}/store2', [App\Http\Controllers\BusinessController::class, 'store2'])
       ->name('businesses.store2');

Route::resource('/businesses', BusinessController::class);

Route::get('/advertisings/{project}/create2', [App\Http\Controllers\AdvertisingController::class, 'create2'])
       ->name('advertisings.create2');

Route::get('/advertisings/{project}/edit2', [App\Http\Controllers\AdvertisingController::class, 'edit2'])
       ->name('advertisings.edit2');

Route::get('/advertisings/query', [App\Http\Controllers\AdvertisingController::class, 'query'])
       ->name('advertisings.query');

Route::post('/advertisings/{project}/{advertising}/store2', [App\Http\Controllers\AdvertisingController::class, 'store2'])
       ->name('advertisings.store2');

Route::resource('/advertisings', AdvertisingController::class);

Route::get('/appadvertisings/query', [App\Http\Controllers\AppAdvertisingController::class, 'query'])
       ->name('appadvertisings.query');

Route::resource('/appadvertisings', AppAdvertisingController::class);

Route::get('/mainvideos/{project}/create2', [App\Http\Controllers\MainVideoController::class, 'create2'])
       ->name('mainvideos.create2');

Route::get('/mainvideos/{project}/edit2', [App\Http\Controllers\MainVideoController::class, 'edit2'])
       ->name('mainvideos.edit2');

Route::get('/mainvideos/query', [App\Http\Controllers\MainVideoController::class, 'query'])
       ->name('mainvideos.query');

Route::post('/mainvideos/{project}/{mainvideo}/store2', [App\Http\Controllers\MainVideoController::class, 'store2'])
       ->name('mainvideos.store2');

Route::resource('/mainvideos', MainVideoController::class);

Route::get('/appmenus/{project}/{position}/create2', [App\Http\Controllers\AppMenuController::class, 'create2'])
       ->name('appmenus.create2');

Route::get('/appmenus/{project}/{position}/edit2', [App\Http\Controllers\AppMenuController::class, 'edit2'])
       ->name('appmenus.edit2');

Route::post('/appmenus/{project}/{position}/{appmenu}/store2', [App\Http\Controllers\AppMenuController::class, 'store2'])
       ->name('appmenus.store2');

Route::get('/appmenus/query', [App\Http\Controllers\AppMenuController::class, 'query'])
       ->name('appmenus.query');

Route::resource('/appmenus', AppMenuController::class);

Route::get('/menus/query', [App\Http\Controllers\MenuController::class, 'query'])
       ->name('menus.query');

Route::resource('/menus', MenuController::class);

Route::get('/bulletins/{projec}/create2', [App\Http\Controllers\BulletinController::class, 'create2'])
       ->name('bulletins.create2');

Route::get('/bulletins/{project}/edit2', [App\Http\Controllers\BulletinController::class, 'edit2'])
       ->name('bulletins.edit2');

Route::post('/bulletins/{project}/{bulletin}/store2', [App\Http\Controllers\BulletinController::class, 'store2'])
       ->name('bulletins.store2');

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

Route::get('/voicesettings/query', [App\Http\Controllers\VoiceSettingController::class, 'query'])
       ->name('voicesettings.query');

Route::resource('/voicesettings', VoiceSettingController::class);

Route::get('/customersupports/query', [App\Http\Controllers\CustomerSupportController::class, 'query'])
       ->name('customersupports.query');

Route::resource('customersupports', CustomerSupportController::class);

Route::get('/elearningcatagories/query', [App\Http\Controllers\ELearningCatagoryController::class, 'query'])
       ->name('elearningcatagories.query');

Route::resource('/elearningcatagories', ELearningCatagoryController::class);

Route::get('elearnings/query', [App\Http\Controllers\ELearningController::class, 'query'])
       ->name('elearnings.query');

Route::resource('/elearnings', ELearningController::class);

Route::get('/packages/query', [App\Http\Controllers\PackageController::class, 'query'])
       ->name('packages.query');

Route::resource('/packages', PackageController::class);

Route::get('/apkmanagers/query', [App\Http\Controllers\ApkManagerController::class, 'query'])
       ->name('apkmanagers.query');

Route::resource('/apkmanagers', ApkManagerController::class);

Route::resource('/managers', ManagerController::class);

Route::resource('/resellers', ResellerController::class);

Route::resource('/members', MemberController::class);

Route::get('/apiinterface/register', [App\Http\Controllers\ApiInterfaceController::class, 'register'])
       ->name('apiinterface.register');
