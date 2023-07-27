<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/404', function () {
    abort(404);
});
Route::get('/clear-cache', function() {
   $exitCode = Artisan::call('cache:clear');
   // return what you want
});
Route::get('/clear-optimize', function() {
   $exitCode = Artisan::call('optimize:clear');
   // return what you want
});
Route::get('/clear-view', function() {
   $exitCode = Artisan::call('view:clear');
   // return what you want
});
Route::group(['prefix' => 'backend','as' => 'admin_'], function() {
    Route::get('login', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('XSS');
    Route::post('checkedlogin', [App\Http\Controllers\Backend\Auth\LoginController::class, 'login'])->name('checkedlogin')->middleware('XSS');
    Route::get('logout/', [App\Http\Controllers\Backend\Auth\LoginController::class, 'logout'])->name('logout')->middleware('XSS');
    Route::get('/', [App\Http\Controllers\Backend\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('XSS');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard')->middleware('XSS');

        Route::get('change-password', [App\Http\Controllers\Backend\DashboardController::class, 'showchangePasswordForm'])->name('change-password')->middleware('XSS');
        Route::post('change-password', [App\Http\Controllers\Backend\DashboardController::class, 'changePassword'])->name('change-password')->middleware('XSS');

        Route::get('site-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'index'])->name('site-settings');
        Route::post('site-settings', [\App\Http\Controllers\Backend\SettingsController::class, 'update'])->name('site-settings');

        Route::get('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'index'])->name('email-templates');
        Route::post('email-templates', [\App\Http\Controllers\Backend\EmailTemplatesController::class, 'update'])->name('email-templates');

        Route::get('pages',[App\Http\Controllers\Backend\PageController::class, 'index'])->name('pages');
        Route::get('page-create',[App\Http\Controllers\Backend\PageController::class, 'create'])->name('page-create');
        Route::post('page-store',[App\Http\Controllers\Backend\PageController::class, 'store'])->name('page-store');
        Route::get('page-edit/{id}',[App\Http\Controllers\Backend\PageController::class, 'edit'])->name('page-edit');
        Route::post('page-update/{id}',[App\Http\Controllers\Backend\PageController::class, 'update'])->name('page-update');
        Route::get('page-delete/{id}', [App\Http\Controllers\Backend\PageController::class, 'destroy'])->name('page-delete');
        Route::post('page-datatable', [App\Http\Controllers\Backend\PageController::class, 'pagesDatatable'])->name('page-datatable');

        Route::get('smtp', [App\Http\Controllers\Backend\SMTPController::class, 'index'])->name('smtp')->middleware('XSS');
        Route::post('smtp_update', [App\Http\Controllers\Backend\SMTPController::class, 'update'])->name('smtp_update')->middleware('XSS');
    });
});
Route::group(['as' => 'front_', 'middleware' => 'XSS'], function() {
    Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('/');
    Route::get('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Front\Auth\RegisterController::class, 'register'])->name('register');
    Route::get('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Front\Auth\LoginController::class, 'login'])->name('login');
    Route::get('logout', [\App\Http\Controllers\Front\Auth\LoginController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showForgetForm'])->name('forgot-password');
    Route::post('forgot-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'sendForgetLink'])->name('forgot-password');
    Route::get('reset-password/{token?}', [\App\Http\Controllers\Front\Auth\LoginController::class, 'showResetPasswordForm'])->name('reset-password');
    Route::post('set-new-password', [\App\Http\Controllers\Front\Auth\LoginController::class, 'resetPassword'])->name('set-new-password');

});
